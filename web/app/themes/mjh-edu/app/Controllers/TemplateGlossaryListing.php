<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;
use \DOMDocument;
use \DOMXPath;
use \DOMText;

class TemplateGlossaryListing extends Controller
{
	/**
	 * Constructor
	 *
	 * @return none
	 */
	public function TemplateGlossaryListing()
	{

	}
	/**
	 * Get glossaries listing
	 *
	 * @return array
	 */
	public function glossaries(){
		$pParamHash = $this->setAlphaHash();
		$glossaries = TemplateGlossaryListing::getGlossary();
		if (!empty($glossaries)) {
			foreach ($glossaries as $word) {
				$letter = substr(strtolower($word->post_title), 0, 1);
				$pParamHash[$letter][] = $word;
			}
			//var_dump($pParamHash);
			return $pParamHash;
		}else{
			return array();
		}
	}

	/**
	 * Get glossary listing from query
	 *
	 * @return array
	 */
	public static function getGlossary(){
		$args = array(
			'post_type' => 'glossary',
			'post_status' => 'publish',
			'posts_per_page'   => -1,
			'orderby' => 'title',
			'order' => 'asc',
		);
		$glossary = new WP_Query( $args);
		if($glossary->post_count){
			return $glossary->posts;
		}else{
			return array();
		}
	}

	/**
	 * Get alpha hash array
	 *
	 * @return array
	 */
	private function setAlphaHash(){
		$pParamHash = array();
		foreach (range('a', 'z') as $letter) {
			$pParamHash[$letter] = array();
		}
		return $pParamHash;
	}

	/**
	 * Parses the pages/posts and adding the tooltips to the terms
	 * Credit Plugin: CM Tooltip Glossary
	 *
	 * @global array $glossary_index
	 * @global array $glossaryIndexArr
	 * @param string $content
	 * @return string
	 */
	public static function cmttGlossaryParse( $content ) {
		global $glossary_index;
		$seo = doing_action( 'wpseo_head' );
		if ( $seo ) {
			return $content;
		}
		/*
		 * Initialize $glossarySearchStringArr as empty array
		 */
		$glossarySearchStringArr = array();

		/*
		 * Run the glossary parser
		 */
		if ( empty( $glossary_index ) ) {
			$glossary_index = get_posts( array(
				'post_type'              => 'glossary',
				'post_status'            => 'publish',
				'order'                  => 'DESC',
				'orderby'                => 'title',
				'numberposts'            => -1,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false
			) );
			uasort( $glossary_index, 'self::cmttSortPostsTitleLength' );
		}
		if ( $glossary_index ) {
			global $glossaryIndexArr;
			/*
			 * The loops prepares the search query for the replacement
			 */
			foreach ( $glossary_index as $glossary_item ) {
				$glossary_title = preg_quote( htmlspecialchars( trim( $glossary_item->post_title ), ENT_COMPAT, 'UTF-8' ), '/' );
				$glossaryIndexArrKey = $glossary_title;
				$glossaryIndexArrKey = mb_strtolower( $glossaryIndexArrKey );
				$glossarySearchStringArr[]                = $glossary_title;
				$glossaryIndexArr[ $glossaryIndexArrKey ] = $glossary_item;
			}

			/*
			 * No replace required if there's no glossary items
			 */
			if ( !empty( $glossarySearchStringArr ) && is_array( $glossarySearchStringArr ) ) {
				$glossaryArrayChunk = 150;
				$spaceSeparated     = TRUE;
				$caseSensitive = false;
				if ( count( $glossarySearchStringArr ) > $glossaryArrayChunk ) {
					$chunkedGlossarySearchStringArr = array_chunk( $glossarySearchStringArr, $glossaryArrayChunk, TRUE );
					foreach ( $chunkedGlossarySearchStringArr as $glossarySearchStringArrChunk ) {
						$glossarySearchString = '/' . (($spaceSeparated) ? '(?<=\P{L}|^)(?<!(\p{N}))' : '') . '(?!(<|&lt;))(' . (!$caseSensitive ? '(?i)' : '') . implode( '|', $glossarySearchStringArrChunk ) . ')(?!(>|&gt;))' . (($spaceSeparated) ? '(?=\P{L}|$)(?!(\p{N}))' : '') . '/u';
						$content              = self::cmttDomStrReplace( $content, $glossarySearchString );
					}
				} else {
					$glossarySearchString = '/' . (($spaceSeparated) ? '(?<=\P{L}|^)(?<!(\p{N}))' : '') . '(?!(<|&lt;))(' . (!$caseSensitive ? '(?i)' : '') . implode( '|', $glossarySearchStringArr ) . ')(?!(>|&gt;))' . (($spaceSeparated) ? '(?=\P{L}|$)(?!(\p{N}))' : '') . '/u';
					$content              = self::cmttDomStrReplace( $content, $glossarySearchString );
				}
			}
		}
		return $content;
	}

	/**
	 * Sort post title by length
	 * Credit Plugin: CM Tooltip Glossary
	 *
	 * @param object $a post_object
	 * @param object $b post_object
	 * @return int
	 */
	public static function cmttSortPostsTitleLength($a, $b)
	{
		$sortVal = 0;
		if( property_exists($a, 'post_title') && property_exists($b, 'post_title') )
		{
			$sortVal = strlen($b->post_title) - strlen($a->post_title);
		}
		return $sortVal;
	}

	/**
	 * Search the terms in the content
	 * Credit Plugin: CM Tooltip Glossary
	 * @param string $html
	 * @param string $glossarySearchString
	 * @return string
	 */
	public static function cmttDomStrReplace( $html, $glossarySearchString ) {
		global $replacedTerms;
		$replacedTerms = is_array( $replacedTerms ) ? $replacedTerms : array();
		if ( !empty( $html ) && is_string( $html ) ) {
			$dom = new DOMDocument();
			/*
			 * loadXml needs properly formatted documents, so it's better to use loadHtml, but it needs a hack to properly handle UTF-8 encoding
			 */
			libxml_use_internal_errors( true );
			if ( !$dom->loadHtml( mb_convert_encoding( $html, 'HTML-ENTITIES', "UTF-8" ) ) ) {
				libxml_clear_errors();
			}
			$xpath = new DOMXPath( $dom );
			/*
			 * Base query NEVER parse in scripts
			 */
			$query = '//text()[not(ancestor::script)][not(ancestor::style)]';
			/*
			 * Parsing of the wp-captions
			 */
			$query .= '[not(ancestor::*[contains(concat(\' \', @class, \' \'), \' wp-caption \')])]';
			foreach ( $xpath->query( $query ) as $node ) {
				/* @var $node DOMText */
				$replaced = preg_replace_callback( $glossarySearchString, "self::cmttReplaceMatches", htmlspecialchars( $node->wholeText, ENT_COMPAT ) );
				if ( !empty( $replaced ) ) {
					$newNode            = $dom->createDocumentFragment();
					$replacedShortcodes = strip_shortcodes( $replaced );
					$result             = $newNode->appendXML( '<![CDATA[' . $replacedShortcodes . ']]>' );
					if ( $result !== false ) {
						$node->parentNode->replaceChild( $newNode, $node );
					}
				}
			}
			/*
			 *  get only the body tag with its contents, then trim the body tag itself to get only the original content
			 */
			$bodyNode = $xpath->query( '//body' )->item( 0 );
			if ( $bodyNode !== NULL ) {
				$newDom = new DOMDocument();
				$newDom->appendChild( $newDom->importNode( $bodyNode, TRUE ) );

				$intermalHtml = $newDom->saveHTML();
				$html         = mb_substr( trim( $intermalHtml ), 6, (mb_strlen( $intermalHtml ) - 14 ), "UTF-8" );
				/*
				 * Fixing the self-closing which is lost due to a bug in DOMDocument->saveHtml() (caused a conflict with NextGen)
				 */
				$html         = preg_replace( '#(<img[^>]*[^/])>#Ui', '$1/>', $html );
			}
		}

		return $html;
	}

	/**
	 * Replaces the matches
	 * Credit Plugin: CM Tooltip Glossary
	 *
	 * @param string $match
	 * @return string
	 */
	public static function cmttReplaceMatches( $match ) {
		if ( !empty( $match[ 0 ] ) ) {
			$replacementText = self::cmttPrepareReplaceTemplate( htmlspecialchars_decode( $match[ 0 ], ENT_COMPAT ) );
			return $replacementText;
		}
	}

	/**
	 * Function which prepares the templates for the glossary words found in text
	 ** Credit Plugin: CM Tooltip Glossary
	 *
	 * @param string $title replacement text
	 * @return array|string
	 */
	public static function cmttPrepareReplaceTemplate( $title ) {
		/*
		 * Placeholder for the title
		 */
		$titlePlaceholder = '##TITLE_GOES_HERE##';
		/*
		 * Array of glossary items, settings
		 */
		global $glossaryIndexArr, $caseSensitive, $templatesArr;
		/*
		 * If it's case insensitive, then the term keys are stored as lowercased
		 */
		$normalizedTitle = preg_quote( htmlspecialchars( trim( $title ), ENT_COMPAT, 'UTF-8' ), '/' );
		$titleIndex      = (!$caseSensitive) ? mb_strtolower( $normalizedTitle ) : $normalizedTitle;
		/*
		 * Upgrade to make it work with synonyms
		 */
		if ( $glossaryIndexArr ) {
			/*
			 * First - look for exact keys
			 */
			if ( array_key_exists( $titleIndex, $glossaryIndexArr ) ) {
				$glossary_item = $glossaryIndexArr[ $titleIndex ];
			}
		}
		/*
		 * Error checking
		 */
		if ( !is_object( $glossary_item ) ) {
			return $title;
		}
		$id = $glossary_item->ID;
		/*
		 * Replacement is already cached - use it
		 */
		if ( !empty( $templatesArr[ $id ] ) ) {
			$templateReplaced = str_replace( $titlePlaceholder, $title, $templatesArr[ $id ] );
			return $templateReplaced;
		}
		$link_replace = '<a href="'.get_home_url().'/glossary/#'.$glossary_item->post_name.'" data-toggle="tooltip" title="'.$glossary_item->post_content.'">'.$glossary_item->post_title.'</a> ';
		/*
		 * Save with $titlePlaceholder - for the synonyms
		 */
		$templatesArr[ $id ] = $link_replace;
		/*
		 * Replace it with title to show correctly for the first time
		 */
		$link_replace = str_replace( $titlePlaceholder, $title, $link_replace );
		return $link_replace;
	}
}