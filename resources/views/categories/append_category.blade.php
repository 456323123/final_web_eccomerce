 <div class="form-group">
                  <label>Select category-level</label>
                  <select name="parent_id" id="parent_id"  class="form-control"   style="width: 100%;">
                    <option value="0" @if(isset($categorydata['parent_id']) && $categorydata['parent_id']==0) selected="" @endif>Main category</option>
                    @if(!empty($categorystore))
                       @foreach($categorystore as $getcategory)
                            <option value="{{ $getcategory['id'] }}" @if(isset($categorydata['parent_id']) && $categorydata['parent_id']==$getcategory['id']) selected="" @endif>{{ $getcategory['category_name'] }}</option>

                             @if(!empty($getcategory['subcategories']))
                       @foreach($getcategory['subcategories'] as $subcategory)
                            <option value="{{ $subcategory['id'] }}">&nbsp;&raquo;&nbsp; {{ $subcategory['category_name'] }}</option>
                       @endforeach
@endif
                       @endforeach


                    @endif
                  </select>
                </div>
