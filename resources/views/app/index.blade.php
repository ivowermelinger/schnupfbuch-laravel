@section('title', $heading)

<x-layout>
   <main-app class="touch">
      <div class="container full-height">
         <div class="row full-height">
            <div class="col-12">
               <div class="touch__area">
                  <button id="line" class="btn btn--loading touch__trigger">
                  </button>

                  <div class="row">
                     <div class="col-6">
                        <button id="like" class="btn btn--icon">
                           <span>like</span>
                        </button>
                     </div>
                     <div class="col-6">
                        <button id="dislike" class="btn btn--icon">
                           <span>dislike</span>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
    </main-app>
</x-layout>
