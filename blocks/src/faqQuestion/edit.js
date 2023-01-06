import { RichText, InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import classNames from 'classnames';
import icon from './icon';

const ALLOWED_FORMATS = [ 'core/bold', 'core/link' ];

const Edit = ( props ) => {
	const {
		attributes: { question },
		className,
		setAttributes,
		isActive,
	} = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'faq__question' ),
	} );

	return (
		<div { ...blockProps }>
			<RichText
				tagName="h3"
				value={ question }
				onChange={ ( value ) => {
					setAttributes( { question: value } );
				} }
				isActive={ isActive }
				placeholder={ __(
					'Add Question...',
					'site-functionality'
				) }
			/>
			<a href="#" className="chevron">
				{ icon }
			</a>
		</div>
	);
};

export default Edit;
