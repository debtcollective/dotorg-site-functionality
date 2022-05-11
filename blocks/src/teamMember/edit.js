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
		'core/image',
		{
			placeholder: __( 'Add image...', 'site-functionality' ),
			className: 'person__image',
		},
		[],
	],
	[
		'core/heading',
		{
			placeholder: __( 'Name…', 'site-functionality' ),
			level: 3,
			className: 'person__name',
		},
		[],
	],
	[
		'core/paragraph',
		{
			placeholder: __( 'Title...', 'site-functionality' ),
			className: 'person__title',
		},
		[],
	]
];

const ALLOWED_BLOCKS = [
	'core/heading',
	'core/paragraph',
	'core/image',
];

const Edit = ( props ) => {
	console.log("team member Edit block")
	const { attributes, className } = props;
	const blockProps = useBlockProps( {
		className: classNames( className, 'team-member', 'person' ),
	} );

	return (
		<div { ...blockProps }>
			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				template={ TEMPLATE }
				// templateLock="all"
			/>
		</div>
	);
};

export default Edit;
