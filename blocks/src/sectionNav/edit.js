import {
	BlockControls,
	InspectorControls,
	useBlockProps,
} from '@wordpress/block-editor';

import {
	Panel,
	PanelBody,
	PanelRow,
	SelectControl,
	Spinner,
} from '@wordpress/components';

import { __ } from '@wordpress/i18n';

import classNames from 'classnames';

//  Import CSS.
import './editor.scss';
// import './style.scss';

const Edit = ( props ) => {
	const {
		attributes: {
			type
		},
		setAttributes,
		className,
	} = props;

	const setType = ( value ) => {
		setAttributes(
			{
				type: value
			}
		);
	}

	const TypeSelector = () => {
		const options = [
			{
				value: 'sibling',
				label: __( 'Sibling-page Navigation', 'site-functionality' ),
			},
			{
				value: 'children',
				label: __( 'Sub-page Navigation', 'site-functionality' ),
			},
		];

		if ( ! options || ! options.length ) {
			return <Spinner />;
		}

		return (
			<>
				<SelectControl
					label={ __( 'Display Section Navigation', 'site-functionality' ) }
					options={ options }
					onChange={ setType }
					value={ type }
				/>
			</>
		);
	};

	const SettingsPanel = () => {
		return (
			<InspectorControls>
				<PanelBody
					title={ __( 'Block Options', 'site-functionality' ) }
					initialOpen={ true }
				>
					<PanelRow>
						<TypeSelector />
					</PanelRow>
				</PanelBody>
			</InspectorControls>
		);
	};

	const blockProps = useBlockProps( {
		className: classNames( className, 'pagenav' ),
	} );

	return (
		<>
			<SettingsPanel />
		</>
	);
};

export default Edit;
