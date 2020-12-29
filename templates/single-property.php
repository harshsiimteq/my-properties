<div class="bg-white p-5">
    <h1 class="text-3xl">Edit Property: <?php echo $property['property_name']; ?></h1>
</div>
<div class="mt-10 px-5">
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="property_id" value="<?php echo $property['property_id']; ?>">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="property_name" class="block text-sm font-medium text-gray-700">Property
                                Name</label>
                            <input type="text" name="property_name" value="<?php echo $property['property_name']; ?>"
                                   id="property_name"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="property_url" class="block text-sm font-medium text-gray-700">Property
                                URL</label>
                            <input type="text" name="property_url" value="<?php echo $property['property_url']; ?>"
                                   id="property_url"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="property_description" class="block text-sm font-medium text-gray-700">Property
                                Description</label>
                            <textarea name="property_description" id="property_description"
                                      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"><?php echo $property['property_description']; ?></textarea>
                        </div>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="property_type" class="block text-sm font-medium text-gray-700">Property Type</label>
                        <select id="property_type" name="property_type" autocomplete="property_type"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="commercial" <?php echo $property['property_type'] == 'commercial' ? 'selected' : ''; ?>>
                                Commercial
                            </option>
                            <option value="residential" <?php echo $property['property_type'] == 'residential' ? 'selected' : ''; ?>>
                                Residential
                            </option>
                            <option value="industrial" <?php echo $property['property_type'] == 'industrial' ? 'selected' : ''; ?>>
                                Industrial
                            </option>
                        </select>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="property_status" class="block text-sm font-medium text-gray-700">Property
                            Status</label>
                        <select id="property_status" name="property_status" autocomplete="property_status"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="On Sale" <?php echo $property['property_status'] == 'On Sale' ? 'selected' : ''; ?>>
                                On Sale
                            </option>
                            <option value="Sold" <?php echo $property['property_status'] == 'Sold' ? 'selected' : ''; ?>>
                                Sold
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Cover photo
                        </label>
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                     viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="property_image"
                                           class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="property_image" name="property_image" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF up to 10MB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" name="update-property" value="update-property"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>