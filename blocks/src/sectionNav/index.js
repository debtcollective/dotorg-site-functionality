/**
 * WordPress dependencies
 */
 import { __ } from '@wordpress/i18n';

 /**
  * Internal dependencies
  */
 import metadata from './block.json';
 import Edit from './edit';
 import icon from './icon';
 
 const { name, category } = metadata;
 
 const settings = {
	icon,
	edit: Edit,
 };
 
 export { name, category, settings };
 