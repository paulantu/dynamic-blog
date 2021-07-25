<div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
    <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left">
        <li x-data={show:false} class="mr-3 flex-1">
            <a x-on:click.prevent="show=!show" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
                <i class="fas fa-tasks pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Category</span>
            </a>

            <div x-show="show" class="px-4 py-3 my-2 text-gray-700">
                <a href="{{ url('/admin/category') }}" class="p-2 hover:bg-gray-800 text-red-400 text-sm no-underline hover:no-underline hover:bg-gray-100 block"><i class="fa fa-user fa-fw"></i> Category</a>
                <a href="{{ url('/admin/sub-category') }}" class="p-2 hover:bg-gray-800 text-red-400 text-sm no-underline hover:no-underline hover:bg-gray-100 block"><i class="fa fa-cog fa-fw"></i> Sub-category</a>
            </div>
        </li>
        <li class="mr-3 flex-1">
            <a href="{{ url('/admin/home') }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-blue-600">
                <i class="fas fa-chart-area pr-0 md:pr-3 text-blue-600"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">Analytics</span>
            </a>
        </li>
        <li class="mr-3 flex-1">
            <a href="{{ url('/admin/blog') }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                <i class="fa fa-envelope pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Blogs</span>
            </a>
        </li>
        <li x-data={show:false} class="mr-3 flex-1">
            <a x-on:click.prevent="show=!show" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
                <i class="fa fa-wallet pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Manage</span>
            </a>

            <div x-show="show" class="px-4 py-3 my-2 text-gray-700">
                <a href="{{ url('/admin/manage-role') }}" class="p-2 hover:bg-gray-800 text-red-400 text-sm no-underline hover:no-underline hover:bg-gray-100 block"><i class="fa fa-user fa-fw"></i> Role</a>
                <a href="{{ url('/admin/manage-user') }}" class="p-2 hover:bg-gray-800 text-red-400 text-sm no-underline hover:no-underline hover:bg-gray-100 block"><i class="fa fa-cog fa-fw"></i> Users</a>
            </div>
        </li>
    </ul>
</div>
