<div>
    <div class="modal my-modal small-modal" style="display: block;">
        <div class="modal-dialog my-modal-dialog" role="document" style="display: block;">
            <div class="modal-content" style="display: block;">
                <div class="modal-body">
                    <h2 class="modal-title mb-22 text-end mb-4">
                        {{ trans('site.cancel_detect') }}
                    </h2>
                 

                    <!-- إزالة شرط إظهار textarea لأنه يجب أن يكون مرئيًا دائمًا -->
                    <textarea class="form-input form-textarea mt-2  textarea-text w-100" wire:model="note" placeholder="{{ trans('site.note_desc') }}"></textarea>
                    <div class="address-block">
                    @error('note')
                    <small class="text-danger text-end">
                        {{ $message }}
                    </small>
                    @enderror
                    </div>

                    @error('selected_reason')
                    <small class="text-danger text-end">
                        {{ $message }}
                    </small>
                    @enderror
                    <div class="d-flex mt-4 gap-4 justify-content-center">
                        <button class="submit-btn sign-out-yes m-0" wire:click="submit" style="cursor: pointer;">
                            {{ trans('site.send') }}
                        </button>
                        <a class="delete-notifications" wire:click.prevent="$dispatch('closeModal')">
                            {{ trans('site.cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
