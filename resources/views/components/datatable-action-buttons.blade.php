<div class="flex items-center gap-1">
    <x-datatable-edit-button :url="route('agents.edit', $id)" />
    <x-datatable-delete-button :url="route('agents.destroy', $id)" />
</div>
