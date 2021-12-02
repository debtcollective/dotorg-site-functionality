import {
	BlockControls,
	InnerBlocks,
	InspectorControls,
	useBlockProps,
	__experimentalLinkControl as LinkControl,
	__experimentalLinkControlSearchInput as LinkControlSearchInput,
} from '@wordpress/block-editor';

import {
	Button,
	ButtonGroup,
	PanelBody,
	PanelRow,
	ToolbarButton,
	Popover,
} from '@wordpress/components';

import { useEffect, useState, useRef } from '@wordpress/element';

import { displayShortcut, isKeyboardEvent } from '@wordpress/keycodes';
import { link, linkOff } from '@wordpress/icons';

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

const NEW_TAB_REL = 'noreferrer noopener';

const Edit = ( props ) => {
	const {
		attributes,
		isSelected,
		onReplace,
		setAttributes,
		className,
	} = props;

	const { linkTarget, rel, url } = attributes;

	const blockProps = useBlockProps( {
		className: classNames( className, 'tout' ),
	} );
	const ref = useRef();
	const [ isEditingURL, setIsEditingURL ] = useState( false );
	const isURLSet = !! url;
	const opensInNewTab = linkTarget === '_blank';

	function onToggleOpenInNewTab( value ) {
		const newLinkTarget = value ? '_blank' : undefined;

		let updatedRel = rel;
		if ( newLinkTarget && ! rel ) {
			updatedRel = NEW_TAB_REL;
		} else if ( ! newLinkTarget && rel === NEW_TAB_REL ) {
			updatedRel = undefined;
		}

		setAttributes( {
			linkTarget: newLinkTarget,
			rel: updatedRel,
		} );
	}

	function startEditing( event ) {
		event.preventDefault();
		setIsEditingURL( true );
	}

	function unlink() {
		setAttributes( {
			url: '',
			linkTarget: undefined,
			rel: undefined,
		} );
		setIsEditingURL( false );
	}

	useEffect( () => {
		if ( ! isSelected ) {
			setIsEditingURL( false );
		}
	}, [ isSelected ] );

	return (
		<div { ...blockProps }>
			<BlockControls group="block">
				{ ! isURLSet && (
					<ToolbarButton
						name="link"
						icon={ link }
						title={ __( 'Link', 'site-functionality' ) }
						shortcut={ displayShortcut.primary( 'k' ) }
						onClick={ startEditing }
					/>
				) }
				{ isURLSet && (
					<ToolbarButton
						name="link"
						icon={ linkOff }
						title={ __( 'Unlink', 'site-functionality' ) }
						shortcut={ displayShortcut.primaryShift( 'k' ) }
						onClick={ unlink }
						isActive={ true }
					/>
				) }
			</BlockControls>
			{ isSelected && ( isEditingURL || isURLSet ) && (
				<Popover
					position="bottom center"
					onClose={ () => {
						setIsEditingURL( false );
					} }
					anchorRef={ ref?.current }
					focusOnMount={ isEditingURL ? 'firstElement' : false }
				>
					<LinkControl
						className="wp-block-navigation-link__inline-link-input"
						value={ { url, opensInNewTab } }
						onChange={ ( {
							url: newURL = '',
							opensInNewTab: newOpensInNewTab,
						} ) => {
							setAttributes( { url: newURL } );

							if ( opensInNewTab !== newOpensInNewTab ) {
								onToggleOpenInNewTab( newOpensInNewTab );
							}
						} }
						onRemove={ () => {
							unlink();
						} }
						forceIsEditingLink={ isEditingURL }
					/>
				</Popover>
			) }
			{ /* <InspectorControls>
				<PanelBody
					title={ __( 'Link', 'site-functionality' ) }
					initialOpen={ true }
				>
					<LinkControl
						value={ { url, opensInNewTab } }
						onChange={ ( {
							url: newURL = '',
							opensInNewTab: newOpensInNewTab,
						} ) => {
							setAttributes( { url: newURL } );

							if ( opensInNewTab !== newOpensInNewTab ) {
								onToggleOpenInNewTab( newOpensInNewTab );
							}
						} }
						onRemove={ () => {
							unlink();
						}}
						forceIsEditingLink={ isEditingURL }
					/>
				</PanelBody>
			</InspectorControls> */ }

			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				template={ TEMPLATE }
				templateLock="insert"
			/>
		</div>
	);
};

export default Edit;
