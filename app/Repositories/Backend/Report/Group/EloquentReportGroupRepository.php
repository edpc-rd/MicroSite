<?php

namespace App\Repositories\Backend\Report\Group;

use App\Exceptions\GeneralException;
use App\Models\Report\ReportGroup;

/**
 * Class EloquentPermissionGroupRepository
 * @package App\Repositories\Backend\Permission\Group
 */
class EloquentReportGroupRepository implements ReportGroupRepositoryContract
{
    /**
     * @param  int $limit
     * @return mixed
     */
    public function getGroupsPaginated($limit = 50)
    {
        return ReportGroup::with('children', 'reports')
            ->whereNull('parent_id')
            ->orderBy('sort_order', 'asc')
            ->paginate($limit);
    }

    /**
     * @param  bool $withChildren
     * @return mixed
     */
    public function getAllGroups($withChildren = false)
    {
        if ($withChildren) {
            return ReportGroup::orderBy('name', 'asc')->get();
        }

        return ReportGroup::with('children', 'reports')
            ->whereNull('parent_id')
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * @param  $input
     * @return static
     */
    public function store($input)
    {
        $group = new ReportGroup;
        $group->name = $input['name'];
        return $group->save();
    }

    /**
     * @param  $id
     * @param  $input
     * @throws GeneralException
     * @return mixed
     */
    public function update($id, $input)
    {
        $group = $this->find($id);

        //Name is changing for whatever reason
        if ($group->name != $input['name']) {
            if (ReportGroup::where('name', $input['name'])->count()) {
                throw new GeneralException(trans('exceptions.backend.report.groups.name_taken'));
            }
        }

        return $group->update($input);
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function find($id)
    {
        return ReportGroup::findOrFail($id);
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return mixed
     */
    public function destroy($id)
    {
        $group = $this->find($id);

        if ($group->children->count()) {
            throw new GeneralException(trans('exceptions.backend.report.groups.has_children'));
        }

        if ($group->reports->count()) {
            throw new GeneralException(trans('exceptions.backend.report.groups.associated_reports'));
        }

        return $group->delete();
    }

    /**
     * @param  $hierarchy
     * @return bool
     */
    public function updateSort($hierarchy)
    {
        $parent_sort = 1;
        $child_sort  = 1;

        foreach ($hierarchy as $group) {
            $this->find((int) $group['id'])->update([
                'parent_id' => null,
                'sort_order' => $parent_sort,
            ]);

            if (isset($group['children']) && count($group['children'])) {
                foreach ($group['children'] as $child) {
                    $this->find((int) $child['id'])->update([
                        'parent_id' => (int) $group['id'],
                        'sort_order' => $child_sort,
                    ]);

                    $child_sort++;
                }
            }

            $parent_sort++;
        }

        return true;
    }
}
