  
    @foreach($parents as $key=>$parent)
    <option value="{{ $parent->id}}" style="<?php echo group_color(@$i)?>" <?php if(@$parent->id == @$parent_id){ echo "selected";}?>>   {{ $parent->name}} </option>
        @if (count($parent->children) > 0)
            @include('admin.users.partials.child', ['parents' => $parent->children])
            <?php $i++;?> 
        @endif
        
    @endforeach



    
