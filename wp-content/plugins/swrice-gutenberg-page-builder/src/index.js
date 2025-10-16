/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import Edit from './blocks/plugin-page-builder/edit';
import save from './blocks/plugin-page-builder/save';
import metadata from './blocks/plugin-page-builder/block.json';

/**
 * Register the Plugin Page Builder block
 */
registerBlockType(metadata.name, {
	edit: Edit,
	save,
});
