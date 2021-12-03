import {
	InnerBlocks,
	useBlockProps,
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
			className: 'tout__title',
		},
		[],
	],
	[
		'core/paragraph',
		{
			placeholder: __( 'Add content...', 'site-functionality' ),
			className: 'tout__content',
		},
		[],
	],
	[
		'core/button',
		{
			placeholder: __( 'Add button text...', 'site-functionality' ),
			className: 'tout__button btn',
		},
		[],
	],
	[
		'core/image',
		{
			placeholder: __( 'Add image...', 'site-functionality' ),
			className: 'tout__image',
		},
		[],
	],
];

const ALLOWED_BLOCKS = [
	'core/heading',
	'core/paragraph',
	'core/image',
	'core/button',
];

const Edit = ( props ) => {
	const {
		attributes,
		isSelected,
		onReplace,
		setAttributes,
		className,
	} = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'tout button-tout' ),
	} );

	return (
		<div { ...blockProps }>
			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				template={ TEMPLATE }
				templateLock="insert"
			/>
		</div>
	);
};

export default Edit;
