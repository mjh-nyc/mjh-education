# Museum of Jewish Heritage Holocaust Education Website

Base repo to support the Museum of Jewish Heritage Holocaust Education (MJH EDU) website, built in WordPress.

The following notes are more guidelines than enforced policies. Please reach out to the MJH team for any problems, issues, suggestions.

## Repo Notes

- WordPress managed by Bedrock
- Noticably absent from this repo:
- WordPress Core: this is by design, no need to replicate, please do not commit. Lastest WordPress will be installed on servers as part of deployment. Each dev is responsible for setting up their own local dev environment via composer.
- `web/app/uploads/`: also by design, please do not commit
- `.gitignore` has been setup to help enforce these concepts, please update as needed or reasonable if it is causing problems.

## Environment setup

Environment is being managed via [Bedrock](https://roots.io/bedrock/),  a modern WordPress stack that helps you get started with the best development tools and project structure.

### Requirements
* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](https://secure.php.net/manual/en/install.php) >= 7.1.3 (with [`php-mbstring`](https://secure.php.net/manual/en/book.mbstring.php) enabled)
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 6.9.x
* [Yarn](https://yarnpkg.com/en/docs/install)

### Installation

1. Pull in git project repository:
`git pull origin master`

2. MJH team can provide `.env` file and you can customize environment variables in `.env`  file
* `DB_NAME` - Database name
* `DB_USER` - Database user
* `DB_PASSWORD` - Database password
* `DB_HOST` - Database host
* `WP_ENV` - Set to environment (`development`, `staging`, `production`)
* `WP_HOME` - Full URL to WordPress home (http://example.com)
* `WP_SITEURL` - Full URL to WordPress including subdirectory (http://example.com/wp)
* `AUTH_KEY`, `SECURE_AUTH_KEY`, `LOGGED_IN_KEY`, `NONCE_KEY`, `AUTH_SALT`, `SECURE_AUTH_SALT`, `LOGGED_IN_SALT`, `NONCE_SALT`
* `ACF_PRO_KEY` - If using acf pro, provide key with this configuration

If you want to automatically generate the security keys (assuming you have wp-cli installed locally) you can use the very handy [wp-cli-dotenv-command][wp-cli-dotenv] or, you can cut and paste from the [Roots WordPress Salt Generator][roots-wp-salt].

3. Theme is brought down via git repository in `web/app/themes`

4. We are using `http://mjhedu.local` as our local development url

5. Set your site vhost document root to `/path/to/site/web/` (`/path/to/site/current/web/` if using deploys)

6. In project root, run `composer install` to bring down wordpress core, dependencies and contributed plugins

7. Import your database provided by MJH team or it will ask to install barebones copy

8. Access WP admin at `http://mjhedu.local/wp/wp-admin`


## Development / Deployment Workflow

* Deployments to staging and production will be triggered manually by the MJH team

#### Branch Descriptions
* `/master`
* core base code used to merge dev code and keep clean
* `/dev`
* use the dev branch for local development, commit work frequently
* `/staging`
* changes commited to staging will be deployed to staging environment
* `/production`
* contains only production ready code

### Theme Management

* To get the initial theme build, navigate to the theme dir `cd web/app/themes/mjh-edu/`
* Run `yarn` to update dependencies
* Run `yarn build` to compile the build, a `dist` dir will be created, do not commit it, prod and staging branches will be compiled for production by the MJH team

Please review documention in theme directory for further notes. Files can be comitted directly to the root of this git project repository https://github.com/mjh-nyc/mjh-education/tree/master/web/app/themes/mjh-edu

For full deployment notes on the server and additional gotchas, please review this document which requires our permission to access  https://docs.google.com/document/d/1SoaXXOXSsFP4tKAbJFBdC8qcajdo7tqjTbTE9b0_AnY

### Plugin Management

**Contrib Plugins**

- Contrib plugins can be brought in via composer to `/web/app/plugins/yourpluginname` using `composer require <package_name>:<version`> 
- Source for wordpress composer packages  https://wpackagist.org

**Custom Plugins**

- Custom plugins should be set up so that they can be brought in via composer to `/web/app/plugins/yourpluginname`

**Custom Must Use Plugins**

- Custom must use plugins should be set up so that they can be brought in via composer to `/web/app/mu-plugins/yourpluginname`

**Composer setup for custom plugins or must-use plugins**

- This works via git's tagging system. 
-  After you commit files that your ready to deploy, within the plugin reposistory, `git pull origin --tags` to get all the remote tag references and  `git tag -l` to list all tags 
- Create a tag increasing the version number. So if it's 1.0.0, increase to 1.0.1 for minor changes or 1.1.0 for more significant changes or 2.0.0 for complete overhaul or changes of code, this depends on self judgment.  `git tag <version_number>` and then run `git push origin --tags`
- Go back to root directory. 
- For creating a new setup via composer, open `composer.json` and add under `repositories` the following
```,{
"type": "package",
"package": {
"name": "mjh-nyc/<plugin-name>",
"version": "dev-master",
"type": "wordpress-<muplugin or plugin>"
"source": {
"type": "git",
"url": "https://github.com/mjh-nyc/<plugin-name>.git",
"reference": "<git-tag-number>"
}
}
}
```
- For updating the plugin, you will need to update the `reference` to the latest tag number everytime. 
- Once you save, you can then run `composer update mjh-nyc/<plugin-name>` , this will checkout the plugin directory to the tag, add reference in composer.json and composer.lock file.  
- Commit both composer files and push. Run through deployment as usual
- On server, you always only run `composer install`
