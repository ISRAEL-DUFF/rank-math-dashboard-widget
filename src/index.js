import React from 'react';
import { render } from "@wordpress/element";
import App from './App';

document.addEventListener( 'DOMContentLoaded', function() {
    var element = document.getElementById( 'wprk-admin-app' );
    if( typeof element !== 'undefined' && element !== null ) {
        render( <App />, document.getElementById( 'wprk-admin-app' ) );
    }
} )