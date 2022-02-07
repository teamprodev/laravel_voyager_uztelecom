@extends('site.layouts.wrapper')
@section('center_content')


   <div class="bg-blue-50 h-screen">
       <div class="max-w-4xl flex items-center flex-col mx-auto pt-2">

           <div class="sm:w-2/5 w-3/5">
               <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" class="rounded-lg shadow-2xl mx-auto w-44 h-44">
           </div>

           <div id="profile" class="md:w-3/5 w-11/12 rounded-lg shadow-2xl bg-white opacity-75 mt-4">
               <div class="p-4 md:p-12 text-left">
                   <table class="table">
                       <tbody>
                       <tr class="hover:bg-gray-200">
                           <td class="font-medium text-xl p-2">
                               Роль:
                           </td>
                           <td class="p-2">
                               Обычный пользователь
                           </td>
                       </tr>
                       <tr class="hover:bg-gray-200">
                           <td class="font-medium text-xl p-2">
                               Почта:
                           </td>
                           <td class="p-2">
                               user@uztelecom.uz
                           </td>
                       </tr>
                       <tr class="hover:bg-gray-200">
                           <td class="font-medium text-xl p-2">
                               Ф.И.О:
                           </td>
                           <td class="py-4">
                               Кобилов Сардор Маматкулович
                           </td>
                       </tr>
                       <tr class="hover:bg-gray-200">
                           <td class="font-medium text-xl p-2">
                               Филиал:
                           </td>
                           <td class="p-2">
                               Тошкент - 1
                           </td>
                       </tr>
                       <tr class="hover:bg-gray-200">
                           <td class="font-medium text-xl p-2">
                               Должность:
                           </td>
                           <td class="p-2">
                               Ведущий специалист отдела По развитию информационных технологии
                           </td>
                       </tr>
                       <tr class="hover:bg-gray-200">
                           <td class="font-medium text-xl p-2">
                               Тел.номер:
                           </td>
                           <td class="p-2">
                               +9989 99 999 99 99
                           </td>
                       </tr>
                       </tbody>
                   </table>


               </div>

           </div>

       </div>
   </div>



@endsection
