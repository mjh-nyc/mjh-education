// import external dependencies
import 'jquery';

// Import everything from autoload
import "./autoload/**/*"


/*^*^*^**^*^*^*^*^*^*^*^*^*^*^*/
//Added by CLOUDRED */
import 'bootstrap';

//Import Web Font Loader script
import 'gatsby-plugin-web-font-loader/gatsby-browser';

//Import lity responsive lightbox
import 'lity/dist/lity.min';

//Import animsition library
import 'animsition/dist/js/animsition.min';

//Import lity responsive lightbox
import 'lity/dist/lity.min';

// Import Parallax js
import 'jquery-parallax.js/parallax.min';
//jQuery color animation support
import 'jquery-color/jquery.color';

//Import waypoints
import 'waypoints/lib/jquery.waypoints.min';
import 'waypoints/lib/shortcuts/sticky.min';
import 'waypoints/lib/shortcuts/inview.min';

//Import Sticky-kit
import 'sticky-kit/dist/sticky-kit.min';

//Import slick
//import 'slick-carousel/slick/slick';

//**** //END ******************/
/*^*^*^**^*^*^*^*^*^*^*^*^*^*^*/




// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';
import templateSurvivorsListing from './routes/templateSurvivorsListing';
import templateTimelineListing from './routes/templateTimelineListing';
import singleSurvivorStory from './routes/singleSurvivorStory';
import templateEventsListing from './routes/templateEventsListing';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
  // Survivor listing template
    templateSurvivorsListing,
  // Survivor listing template
    templateTimelineListing,
  // Survivor story detail template
    singleSurvivorStory,
    // Events listing template
    templateEventsListing,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
