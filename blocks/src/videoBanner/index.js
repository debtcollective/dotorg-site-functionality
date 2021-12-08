/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { video as icon } from '@wordpress/icons';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import Edit from './edit';
import Save from './save';

const { name, category } = metadata;

const settings = {
	icon,
	edit: Edit,
	save: Save,
};

export { name, category, settings };
