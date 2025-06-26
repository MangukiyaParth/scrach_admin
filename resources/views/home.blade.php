<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Scrach Admin</title>
    <style>
        @media only screen  and (min-width:200px) and (max-width:575px)
        {
            .dlink{
                position:absolute;
                z-index:999;
                bottom:0;
                margin-bottom:-60px;
            }
        }
    </style>
</head>
<body>
    <div>
        <main class="container mx-auto px-4 py-72">
            <div class="text-center">
                Welcome
            </div>
        </main>

        <footer class="relative bg-gray-200 pt-8 pb-6">
            <div
                    class="max-w-[1170px] bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
                    style="height: 80px; transform: translateZ(0px);"
            >
                <svg
                        class="absolute bottom-0 overflow-hidden"
                        xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="none"
                        version="1.1"
                        viewBox="0 0 2560 100"
                        x="0"
                        y="0"
                >
                    <polygon
                            class="text-white fill-current"
                            points="2560 0 2560 100 0 100"
                    ></polygon>
                </svg>
            </div>
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap">
                    <div class="w-full px-4">
                        <div class="flex flex-wrap items-top mb-6">
                            <div class="w-full pt-6 md:pt-0 md:px-4 ml-auto">
                                <span class="block uppercase text-gray-600 text-sm font-semibold mb-2">
                                Resouces
                                </span>
                                <ul class="list-unstyled">
                                    @foreach($pages as $item)
                                    <li>
                                        <a class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm" href="{{url('/page/'.$item->slug)}}" target="_blank">
                                            {{$item->title}}
                                        </a>
                                    </li>
                                    @endforeach
                                
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <hr class="my-6 border-gray-400"> -->
                <div class="flex flex-wrap items-center md:justify-between justify-center">
                    <div class="w-full px-4 mx-auto text-center">
                        <div class="text-sm text-gray-600 font-semibold py-1">
                            Copyright © {{date('Y')}}  Scrach Admin
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</body>
</html>