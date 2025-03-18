<?php

/**
 * SPDX-License-Identifier: MIT
 * Copyright (c) 2017-2018 Tobias Reich
 * Copyright (c) 2018-2025 LycheeOrg.
 */

namespace App\Actions\Album;

use App\Http\Controllers\Gallery\AlbumController;
use App\Models\Album;
use App\Models\Photo;

class SetHeader extends Action
{
	/**
	 * Set the header image of the album.
	 *
	 * @param Album  $album
	 * @param bool   $is_compact
	 * @param ?Photo $photo
	 * @param bool   $shall_override
	 *
	 * @return Album
	 */
	public function do(Album $album, bool $isCompact, ?Photo $photo, bool $shallOverride = false): Album
	{
		if ($isCompact) {
			$album->header_id = AlbumController::COMPACT_HEADER;
		} else {
			$album->header_id = ($album->header_id !== $photo?->id || $shallOverride) ? $photo?->id : null;
		}
		$album->save();

		return $album;
	}
}
