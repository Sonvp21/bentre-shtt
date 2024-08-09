<x-website-layout>
    <section>
        <div class="mx-auto mt-2 max-w-7xl">
            <div class="grid grid-cols-8 gap-4">
              <div class="col-span-8 space-y-10 md:col-span-6 lg:col-span-6">
                <div class="h-full">
                    <div class="grid h-auto grid-cols-5 gap-2">
                        <div class="group col-span-5 flex md:col-span-3">
                            <a href="#" id="featured-route" class="w-full">
                                <article id="featured-post" class="w-full">
                                    <figure class="w-full">
                                        <div class="relative overflow-hidden bg-white h-[362px] w-full">
                                            <img id="featured-image"
                                                class="h-full w-full transition-all group-hover:scale-105 object-cover"
                                                src="https://via.placeholder.com/800x362.png?text=Featured+Image" alt="Featured Image" />
                                            <h2 id="featured-title"
                                                class="w-full absolute bottom-0 right-0 flex items-center justify-center gap-2 bg-white/70 text-normal uppercase text-black px-6 py-4 text-center">
                                                Featured Title
                                            </h2>
                                        </div>
                                    </figure>
                                </article>
                            </a>
                        </div>
            
                        <div class="col-span-5 flex flex-col justify-between md:col-span-2">
                            <div>
                                <div class="divide-y divide-solid divide-gray-300 h-full">
                                    <!-- Example post entries -->
                                    <a class="py-[0.55rem] pl-[0.55rem] inline-block hover-post"
                                        href="#" data-href="#" data-title="Sample Post Title"
                                        data-image="https://via.placeholder.com/100x100.png?text=Thumbnail">
                                        <article class="h-16 flex items-center">
                                            <figure class="group relative flex rounded-t-xl">
                                                <div class="h-auto w-20 flex-none overflow-hidden">
                                                    <img class="h-full w-full transition-all object-cover"
                                                        src="https://via.placeholder.com/100x100.png?text=Thumbnail"
                                                        alt="Sample Post Title" />
                                                </div>
            
                                                <figcaption class="w-full px-3 text-sm">
                                                    <div
                                                        class="text-blue-900 hover:text-red-600 line-clamp-3 leading-5 text-sm text-justify">
                                                        Sample Post Title
                                                        <p class="contents">
                                                            : {!! Str::limit('Sample content for the post. This is a short description of the post content, and should be less than 200 characters.', 200) !!}
                                                        </p>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </article>
                                    </a>
                                    <!-- Repeat similar blocks for more posts -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .current-post {
                        background-color: #dbeafe;
                        position: relative;
                    }
            
                    .current-post::before {
                        content: '';
                        position: absolute;
                        left: -18px;
                        top: 50%;
                        transform: translateY(-50%);
                        width: 0;
                        height: 0;
                        border-left: 10px solid transparent;
                        border-right: 10px solid #0d50a7;
                        border-top: 10px solid transparent;
                        border-bottom: 10px solid transparent;
                        margin-right: 10px;
                    }
                </style>
            </div>
            
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                  <ul
                  class="flex h-auto flex-col divide-y divide-solid overflow-scroll overflow-y-auto overscroll-contain border border-slate-200 px-4 text-sm scrollbar-hide">
                  <!-- Example announcement entries -->
                  <li>
                      <a href="#" class="inline-block gap-2 py-4 text-xs hover:text-red-600">
                          <div
                              class="gap float-left mr-2 divide-y divide-blue-200 overflow-hidden rounded-lg bg-[#fd9f1b] shadow-calendar">
                              <div class="flex-none whitespace-nowrap py-0.5 text-center text-[0.6rem] font-bold text-white">
                                  <span class="px-2">8/2024</span>
                                  <div class="w-full border-b border-dashed border-[#f37303]"></div>
                              </div>
                              <div class="flex h-auto flex-col border-b-2 border-red-500 bg-white text-center">
                                  <span class="relative top-0.5 text-base font-bold leading-3">15</span>
                                  <span class="h-4 text-[0.5rem] font-bold capitalize text-[#fd9f1b]">Friday</span>
                              </div>
                          </div>
                          <h3 class="line-clamp-3 h-12 text-sm text-justify font-normal leading-4 tracking-normal">
                              Demo Announcement Title 1
                          </h3>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="inline-block gap-2 py-4 text-xs hover:text-red-600">
                          <div
                              class="gap float-left mr-2 divide-y divide-blue-200 overflow-hidden rounded-lg bg-[#fd9f1b] shadow-calendar">
                              <div class="flex-none whitespace-nowrap py-0.5 text-center text-[0.6rem] font-bold text-white">
                                  <span class="px-2">8/2024</span>
                                  <div class="w-full border-b border-dashed border-[#f37303]"></div>
                              </div>
                              <div class="flex h-auto flex-col border-b-2 border-red-500 bg-white text-center">
                                  <span class="relative top-0.5 text-base font-bold leading-3">20</span>
                                  <span class="h-4 text-[0.5rem] font-bold capitalize text-[#fd9f1b]">Tuesday</span>
                              </div>
                          </div>
                          <h3 class="line-clamp-3 h-12 text-sm text-justify font-normal leading-4 tracking-normal">
                              Demo Announcement Title 2
                          </h3>
                      </a>
                  </li>
                  <!-- Add more demo announcements as needed -->
              </ul>
              
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="mx-auto mt-2 max-w-7xl">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-10 md:col-span-6 lg:col-span-6">
                    AAAA

                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    BBBB
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="mx-auto mt-2 max-w-7xl">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-10 md:col-span-6 lg:col-span-6">
                    AAA@222
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    BBBBB222
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="mx-auto mt-2 max-w-7xl">
            ZZZZZZZZZZZZZ
        </div>
    </section>
</x-website-layout>
