import { 
    registerBlockType,
    registerBlockCollection
} from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

registerBlockCollection( 'site-functionality', { 
    title: __( 'Debt Collective', 'site-functionality' )
} );

import './patterns';
import './styles';

import * as faqs from './faqs';
import * as faq from './faq';
import * as postmeta from './postmeta';
import * as purchaseAgreements from './purchaseAgreements';

const blocks = [
	faqs,
	faq,
	postmeta,
	purchaseAgreements
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