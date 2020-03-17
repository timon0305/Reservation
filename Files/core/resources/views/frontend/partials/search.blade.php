<form action="{{route('room-list')}}">
    <div class="hero-search-3">
        <input type="text" name="search[arrival]" id="arrival" value="{{$search['arrival']}}" placeholder="Arrival Date" required  autocomplete="off">
    </div>
    <div class="hero-search-3">
        <input type="text" name="search[departure]" id="departure" value="{{$search['departure']}}" placeholder="Departure Date" required autocomplete="off">
    </div>
    <div class="hero-search-2">
        <select name="search[adults]" required >
            @for($i=0;$i <= 8;$i++)
                <option value="{{$i}}" {{$search['adults'] ==$i?'selected':null }}>{{$i?$i:'Adults'}}</option>
            @endfor
        </select>
    </div>
    <div class="hero-search-2">
        <select name="search[children]"  >
            <option value="0">Children</option>
            @for($i=1;$i <= 7;$i++)
                <option value="{{$i}}" {{$search['children'] ==$i?'selected':null }}>{{$i}}</option>
            @endfor
        </select>
    </div>
    <div class="hero-search-2">
        <button type="submit">Check Now</button>
    </div>
</form>