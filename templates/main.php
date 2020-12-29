<div class="bg-white p-5">
    <h1 class="text-3xl">Properties</h1>
</div>
<div class="flex flex-col mt-10">
    <div class="flex justify-end px-5">
        <a href="<?php menu_page_url( 'add-property' ) ?>"
           class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Add New Property
        </a>
    </div>
    <div class="py-2 align-middle inline-block min-w-full px-5">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Property Name
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Description
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
				<?php
				foreach ( $properties as $property ): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="<?php echo $property['property_image']; ?>" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
										<?php echo $property['property_name']; ?>
                                    </div>
                                    <div class="text-sm text-gray-500">
										<?php echo $property['property_url']; ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?php echo $property['property_description']; ?></div>
                            <div class="text-sm text-gray-500"><?php echo $property['property_type']; ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  <?php echo $property['property_status']; ?>
                </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
							<?php echo $property['property_type']; ?>
                        </td>
						<?php
						$url        = get_home_url();
						$url        = $url . "/wp-admin/admin.php?page=properties";
						$url        .= "&property_id=" . $property['property_id'];
						$view_url   = $url . "&action=view";
						$edit_url   = $url . '&action=edit';
						$delete_url = $url . '&action=delete';
						?>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="<?php echo $edit_url; ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form class="inline" method="POST">
                                <input type="hidden" name="property_id" value="<?php echo $property['property_id']; ?>">
                                <button type="submit" class="text-red-600 hover:text-red-900" name="delete-property">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
				<?php endforeach; ?>
                <!-- More rows... -->
                </tbody>
            </table>
        </div>
    </div>
</div>