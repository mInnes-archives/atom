<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Qubit Toolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qubit Toolkit.  If not, see <http://www.gnu.org/licenses/>.
 */

class TermTreeViewAction extends sfAction
{
  public function execute($request)
  {
    $this->resource = $this->getRoute()->resource;

    // Number of siblings that we are showing above and below the current node
    $numberOfPreviousOrNextSiblings = 4;

    switch ($request->show)
    {
      case 'prevSiblings':

        $this->items = $this->resource->getTreeViewSiblings(array('limit' => $numberOfPreviousOrNextSiblings + 1, 'position' => 'previous'));

        $this->hasPrevSiblings = count($this->items) > $numberOfPreviousOrNextSiblings;
        if ($this->hasPrevSiblings)
        {
          array_pop($this->items);
        }

        // Reverse array
        $this->items = array_reverse($this->items);

        break;

      case 'nextSiblings':

        $this->items = $this->resource->getTreeViewSiblings(array('limit' => $numberOfPreviousOrNextSiblings + 1, 'position' => 'next'));

        $this->hasNextSiblings = count($this->items) > $numberOfPreviousOrNextSiblings;
        if ($this->hasNextSiblings)
        {
          array_pop($this->items);
        }

        break;

      case 'item':
      default:

        list($this->items, $this->hasNextSiblings) = $this->resource->getTreeViewChildren(array('numberOfPreviousOrNextSiblings' => $numberOfPreviousOrNextSiblings));

        break;
    }
  }
}
