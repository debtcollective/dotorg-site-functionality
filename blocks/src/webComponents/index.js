import React from 'react';
import ReactDOM from 'react-dom';

import { DonationWidget, MembershipWidget } from '@debtcollective/union-component';

ReactDOM.render(
    React.createElement( DonationWidget ), 
    document.querySelector( "#donation-widget" )
);

ReactDOM.render(
    React.createElement( MembershipWidget ), 
    document.querySelector( "#membership-widget" )
)