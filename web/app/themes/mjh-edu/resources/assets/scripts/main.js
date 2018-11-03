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

//Import waypoints
import 'waypoints/lib/jquery.waypoints.min';
import 'waypoints/lib/shortcuts/sticky.min';

//Import slick
import 'slick-carousel/slick/slick';

//**** //END ******************/
/*^*^*^**^*^*^*^*^*^*^*^*^*^*^*/




// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';
import templateSurvivorsListing from './routes/templateSurvivorsListing';

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
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
