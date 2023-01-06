import {
	BlockControls,
	InnerBlocks,
	useBlockProps,
	__experimentalLinkControl as LinkControl,
	__experimentalLinkControlSearchInput as LinkControlSearchInput,
} from '@wordpress/block-editor';

import { __ } from '@wordpress/i18n';

import classNames from 'classnames';

//  Import CSS.
import './editor.scss';
// import './style.scss';

const TEMPLATE = [
	[
		'core/heading',
		{
			placeholder: __( 'Add Heading...', 'site-functionality' ),
			level: 3,
			className: 'event-tout__title',
		},
		[],
	],
	[
		'core/paragraph',
		{
			placeholder: __( 'Add date...', 'site-functionality' ),
			className: 'event-tout__date',
		},
		[],
	],
	[
		'core/paragraph',
		{
			placeholder: __( 'Add time and timezone...', 'site-functionality' ),
			className: 'event-tout__time',
		},
		[],
	],
	[
		'core/paragraph',
		{
			placeholder: __( 'Add description...', 'site-functionality' ),
			className: 'event-tout__content',
		},
		[],
	],
	[
		'core/button',
		{
			placeholder: __( 'Add button text...', 'site-functionality' ),
			className: 'event-tout__button btn',
		},
		[],
	],
	[
		'core/image',
		{
			placeholder: __( 'Add image...', 'site-functionality' ),
			className: 'event-tout__image',
		},
		[],
	],
];

const ALLOWED_BLOCKS = [
	'core/html',
	'core/heading',
	'core/shortcode',
	'core/paragraph',
	'core/image',
	'core/button',
];

const NEW_TAB_REL = 'noreferrer noopener';

const Edit = ( props ) => {
	const {
		attributes,
		isSelected,
		onReplace,
		setAttributes,
		className,
	} = props;


	const blockProps = useBlockProps( {
		className: classNames( className, 'tout', 'event-tout' ),
	} );

	return (
		<div { ...blockProps }>
			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				template={ TEMPLATE }
			/>
		</div>
	);
};

export default Edit;
