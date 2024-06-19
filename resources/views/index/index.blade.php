@section('title', $heading)

<x-layout>
   <div class="touch">
      <div class="container full-height">
         <div class="row full-height">
            <div class="col-12">
               <div class="touch__area">
                  <button class="btn touch__trigger">
                     <span class="touch__inner">Lorem bla bla </span>
                  </button>

                  <div class="row">
                     <div class="col-6">
                        <button class="btn btn--icon">
                           <span>like</span>
                        </button>
                     </div>
                     <div class="col-6">
                        <button class="btn btn--icon">
                           <span>dislike</span>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</x-layout>