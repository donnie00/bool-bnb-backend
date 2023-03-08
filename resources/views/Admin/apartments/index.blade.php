@include('structure.dashboardAside')

<div class="container">
   <h1 class="my-3">Index</h1>

   <a class="btn btn-warning my-3" href="{{ route('Admin.apartments.create') }}">Add new Apartmet</a>
   <table class="table">
      <thead>
         <tr>
            <th>Title</th>
            <th>Cover</th>
            <th>address</th>
            <th></th>

         </tr>
      </thead>
      <tbody>
         @foreach ($apartments as $apartment)
            <tr>
               <td>{{ $apartment->title }}</td>
               @if ($apartment->cover_img !== null)
                  <td><img src="{{ $apartment->cover_img }}"
                        style="width: 80px; height: 50px; object-fit:cover; object-position: top  " alt="Card image cap">
                  </td>
               @else
                  <td><img src="{{ $apartment->images[0]->image }}"
                        style="width: 80px; height: 50px; object-fit:cover; object-position: top  " alt="Card image cap">
                  </td>
               @endif
               <td>{{ $apartment->address }}</td>

               <td>
                  <div class="d-flex gap-2 ">
                     <a href="{{ route('Admin.apartments.edit', $apartment->id) }}" class=" btn btn-success">Edit</a>
                     <a href="{{ route('Admin.apartments.show', $apartment->id) }}" class=" btn btn-warning">Show</a>
                     <form action="{{ route('Admin.apartments.destroy', $apartment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                     </form>
                     <a href="@{{ --{
    {
        route('Admin.apartments.sponsored', $apartment - > id) }}--}}" class="ms-4 btn btn-info rounded-4">Sponsor</a>
                  </div>
               </td>

            </tr>
         @endforeach
      </tbody>
   </table>




</div>
