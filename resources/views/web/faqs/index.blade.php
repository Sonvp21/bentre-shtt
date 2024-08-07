<x-website-layout>
    <section>

        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 md:col-span-6 lg:col-span-6">

                    <div class="container mx-auto px-4 py-8">
                        <div>
                            <h1 class="text-3xl font-bold text-center mb-4">{{ __('web.faq_page.title_page') }}</h1>
                            <p class=" text-center mb-4">{{ __('web.faq_page.description_page') }}</p>
                            <p class="text-lg mb-10" style="text-indent: 20px;">
                                {{ __('web.faq_page.contact_page') }} <a href="{{ route('contacts.index') }}"
                                    class="text-blue-500">{{ __('web.faq_page.contact_us_page') }}</a></p>

                            <div class="relative">
                                <div
                                    style="background-image: url('{{ asset('files/images/faq_header.png') }}'); background-size: 260px 200px; background-repeat: no-repeat; min-height: 200px; background-position: center; position: relative; z-index: 10;">
                                </div>
                                <div class="relative mt-[-27px] inset-x-0 bottom-0 border-b border-gray-200"
                                    style="z-index: 5;"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-10 mt-6">
                            <div class="container mx-auto p-4">
                                <div class="join join-vertical w-full">
                                  <!-- FAQ Item 1 -->
                                  <div class="collapse collapse-arrow join-item border border-base-300">
                                    <input type="radio" name="faq-accordion" id="faq1" /> 
                                    <label for="faq1" class="collapse-title text-xl font-medium">
                                      How do I pay for my online advertising?
                                    </label>
                                    <div class="collapse-content"> 
                                      <p>Here you would explain the payment methods and procedures for online advertising on your platform.</p>
                                    </div>
                                  </div>
                              
                                  <!-- FAQ Item 2 -->
                                  <div class="collapse collapse-arrow join-item border border-base-300">
                                    <input type="radio" name="faq-accordion" id="faq2" /> 
                                    <label for="faq2" class="collapse-title text-xl font-medium">
                                      What happens to my Facebook and Google Ads campaigns if I cancel my AdEspresso subscription?
                                    </label>
                                    <div class="collapse-content"> 
                                      <p>Details about what happens to active campaigns when a subscription is cancelled would go here.</p>
                                    </div>
                                  </div>
                              
                                  <!-- FAQ Item 3 -->
                                  <div class="collapse collapse-arrow join-item border border-base-300">
                                    <input type="radio" name="faq-accordion" id="faq3" /> 
                                    <label for="faq3" class="collapse-title text-xl font-medium">
                                      What languages does AdEspresso support?
                                    </label>
                                    <div class="collapse-content"> 
                                      <p>Information about supported languages for AdEspresso would be explained here.</p>
                                    </div>
                                  </div>
                              
                                  <!-- More items can be added in a similar pattern -->
                                </div>
                              </div>
                              

                        </div>
                    </div>


                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                  <x-website.announcement />
                  <x-website.science-information />
                  <x-website.aside.extra-curricular-activity />
                  <x-website.aside.study-space />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
