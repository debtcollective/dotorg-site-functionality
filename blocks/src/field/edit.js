import { useBlockProps } from '@wordpress/block-editor';

import { TextControl } from '@wordpress/components';

import { __ } from '@wordpress/i18n';

//  Import CSS.
import './editor.scss';
// import './style.scss';

const Edit = ( props ) => {
	const {
		attributes: { content, type, label, placeholder },
		isSelected,
		onReplace,
		setAttributes,
		className,
	} = props;

	const blockProps = useBlockProps();

	return (
		<div { ...blockProps }>
			<TextControl
				label={ label }
				placeholder={ placeholder }
				value={ content }
				onChange={ ( value ) => setAttributes( { content: value } ) }
				type={ type }
			/>
		</div>
	);
};

export default Edit;
