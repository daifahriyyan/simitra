@php
    
        $data = DataCustomer::where('id', request()->id)->get();

        return json_encode($data);
@endphp