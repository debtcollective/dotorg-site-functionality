import { useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import './editor.scss';

import classNames from 'classnames';

const Edit = ( props ) => {
	const { className } = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'membership-widget' ),
		id: 'membership-widget',
	} );

	return (
		<div { ...blockProps }>Component Placeholder - Membership Widget</div>
	);
};

export default Edit;
