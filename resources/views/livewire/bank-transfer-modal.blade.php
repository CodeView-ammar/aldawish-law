<div>
    <div class="modal my-modal small-modal" style="display: block;">
        <div class="modal-dialog my-modal-dialog" role="document" style="display: block;">
            <div class="modal-content" style="display: block;">
                <div class="modal-body">
                    <h2 class="modal-title mb-22 text-end mb-4">
                        {{ trans('site.bank_transfer') }}
                    </h2>
                    <div class="d-flex mx-5"  style="margin-right: 1rem !important;">
                        <div class="address-block d-flex gap-2">
                            <span class="address-type" style="width: 121px  !important;">
                                {{ trans('site.bank_transfer_receipt') }}
                            </span>
                            <br>
                            <label class="">
                                <input type="file" wire:model="bank_transfer_receipt" class="upload-change address-type-radio" />
                                <span class="upload-btn file-txt" data-title=""></span> <span class="checkmark-2"></span>
                            </label>
                        </div>
                    </div>
                    @error('bank_transfer_receipt')
                    <small class="text-danger" style="margin-top: 10px !important;">
                        {{ $message }}
                    </small>
                    @enderror
                    
                    <div class="d-flex mt-4 gap-4 justify-content-center">
                        <button class="submit-btn sign-out-yes m-0" wire:click="submit">
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
