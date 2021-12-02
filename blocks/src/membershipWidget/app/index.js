import React from 'react';
import ReactDOM from 'react-dom';

import { MembershipWidget } from '@debtcollective/union-component';

ReactDOM.render(
    React.createElement( MembershipWidget ), 
    document.querySelector( "#memberhsip-widget" )
)