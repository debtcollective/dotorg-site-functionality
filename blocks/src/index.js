import { registerBlockType, registerBlockCollection } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

registerBlockCollection( 'site-functionality', {
	title: __( 'Debt Collective', 'site-functionality' ),
} );
import './editor.scss';
import './patterns';
import './styles';

import * as eventTout from './eventTout';
import * as dateTimeField from './dateTimeField';
import * as donationWidget from './donationWidget';
import * as field from './field';
import * as membershipWidget from './membershipWidget';
import * as faqs from './faqs';
import * as faq from './faq';
import * as impactfulCallout from './impactfulCallout';
import * as postmeta from './postmeta';
import * as purchaseAgreements from './purchaseAgreements';
import * as tout from './tout';
import * as buttonTout from './buttonTout';
import * as userQuery from './userQuery';
import * as taxonomySelector from './taxonomySelector';

const blocks = [
	eventTout,
	dateTimeField,
	donationWidget,
	field,
	membershipWidget,
	faqs,
	faq,
	impactfulCallout,
	postmeta,
	purchaseAgreements,
	tout,
	buttonTout,
	userQuery,
	taxonomySelector,
];

/**
 * Function to register an individual block.
 *
 * @param {Object} block The block to be registered.
 *
 */
const registerBlock = ( block ) => {
	if ( ! block ) {
		return;
	}

	const { name, settings } = block;

	registerBlockType( name, {
		...settings,
	} );
};

/**
 * Function to register blocks
 */
export const registerBlocks = () => {
	blocks.forEach( registerBlock );
};

registerBlocks();
