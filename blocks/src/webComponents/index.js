import React from 'react';
import ReactDOM from 'react-dom';

import {
	DonationWidget,
	MembershipWidget,
} from '@debtcollective/union-component';

if ( document.getElementById( 'donation-widget' ) ) {
	ReactDOM.render(
		React.createElement( DonationWidget ),
		document.querySelector( '#donation-widget' )
	);
}

if ( document.getElementById( 'membership-widget' ) ) {
	ReactDOM.render(
		React.createElement( MembershipWidget ),
		document.querySelector( '#membership-widget' )
	);
}
