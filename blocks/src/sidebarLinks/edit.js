import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import classNames from 'classnames';

//  Import CSS.
import './editor.scss';

const TEMPLATE = [
	[
		'site-functionality/sidebar-link',
		{
			placeholder: __( 'Add Link...', 'site-functionality' ),
			className: 'sidebar-link',
		},
		[],
	],
];

const ALLOWED_BLOCKS = [ 'site-functionality/sidebar-link' ];

const Edit = ( props ) => {
	const {
		attributes: { recordId, anchor },
		className,
		setAttributes,
		clientId,
	} = props;

	setAttributes( {
		recordId: clientId,
	} );

	const blockProps = useBlockProps( {
		className: classNames( className, 'sidebar-links' ),
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
