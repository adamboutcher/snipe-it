
    
    @empty($fields) {{-- There was an error? --}}
    
    <div class="row">
        <div class="col-md-7 col-md-offset-3 has-error">
            <span class="help-block form-error">There was a problem retrieving the fields for this fieldset.</span>
        </div>
    </div>
    
    @else
        {{-- NOTE: This stuff could work well also for the 'view this asset and do its custom fields' thing --}}
        {{-- I don't know if we break *here* or if we break per field element? --}}
        @foreach ($fields as $field)
            <div class="form-group">
            
                    <label class="col-md-3 control-label{{ $errors->has($field->name) ? ' has-error' : '' }}" for="default-value{{ $field->id }}">{{ $field->name }}</label>

                    <div class="col-md-7">

                        @if ($field->element == "text")
                            <input b-if="field.type == 'text'" class="form-control m-b-xs" type="text" :value="getValue(field)" :id="'default-value' + field.id" :name="'default_values[' + field.id + ']'">
                        @elseif($field->element == "textarea")
                            <textarea x-if="field.type == 'textarea'" class="form-control" :value="getValue(field)" :id="'default-value' + field.id" :name="'default_values[' + field.id + ']'"></textarea><br>
                        @elseif($field->element == "listbox")

                            <select Z-if="field.element == 'listbox'" class="form-control m-b-xs" :name="'default_values[' + field.id + ']'">
                                <option value=""></option>
                                @foreach($field->field_values as $field_value)
                                    <option Q-for="field_value in field.field_values_array" :value="field_value" :selected="getValue(field) == field_value">{{ $field_value }}</option>
                                @endforeach
                            </select>
                        @else
                            <span class="help-block form-error">
                                Unknown field element: {{ $field->element }}
                            </span>
                        @endif
                    </div>
                </div>

        @endforeach
    @endif
