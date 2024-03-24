<select id="month_id" name="month_id" class="btn btn-sm btn-outline-primary dropdown-toggle">
    <option value="" class="dropdown-item">Select Month</option>
    @foreach($months as $key => $month)
    <?php
 //   $monthID = isset($collection[$key]) ? $collection[$key]->month_id : 0;
    ?>
    <option value="{{ $month->id }}" class="dropdown-item"  >
        {{ $month->month  }}
    </option>
    @endforeach
</select>