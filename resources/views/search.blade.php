<x-app-layout>
  {{--背景--}}
  <div class="w-screen h-screen bg-[#2d197c] flex items-center justify-center font-sans">
    {{--Todoリストカード--}}}
    <div class="w-[50vw] p-[30px] bg-white rounded-md">
      {{--ヘッダー--}}
      <div class="flex justify-between">
        <p class="mb-[15px] font-bold text-[24px]">タスク検索</p>
        <div class="flex items-center text-[16px] mb-[15px]">
          <p class="mr-4">「{{$user_name}}」でログイン中</p>
          <form method="post" action="{{route('logout')}}">
            @csrf
            <button type="submit" class="text-[12px] bg-transparent hover:bg-red-500 text-red-500 font-semibold hover:text-white py-2 px-3 border border-red-500 hover:border-transparent rounded">
              ログアウト
            </button>
          </form>
        </div>
      </div>
      {{--Todoリスト--}}
      <div>
        @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
        {{--Todo検索--}}
        <form action="{{route('todo.search')}}" class="flex justify-between mb-[30px]">
          @csrf
          <input type="text" name="keyword" class="w-3/4 p-[5px] rounded-md border-[#ccc]">
          <select name="tag_id" class="rounded-[5px] text-[14px]">
            <option></option>
            @foreach($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->content}}</option>
            @endforeach
          </select>
          <button type="submit" class="text-[12px] bg-transparent hover:bg-[#dc70fa] text-[#dc70fa] font-semibold hover:text-white py-2 px-3 border border-[#dc70fa] hover:border-transparent rounded">
            検索
          </button>
        </form>
        {{--Todo一覧・編集--}}
        <table class="text-center w-full mb-6">
          <tbody>
            <tr class="font-bold">
              <td>作成日</td>
              <td>タスク名</td>
              <td>タグ</td>
              <td>更新</td>
              <td>削除</td>
            </tr>
            @foreach($todos as $todo)
            <form method="post">
              @csrf
              <tr>
                <td>{{$todo->created_at}}</td>
                <td><input type="text" name="content" value="{{$todo->content}}" class="w-[90%] rounded-md"></td>
                <td><select name="tag_id" class="rounded-[5px]">
                    @foreach($tags as $tag)
                    <option value="{{$tag->id}}" {{$todo->isSelectedTag($tag->id)}}>
                      {{$tag->content}}
                    </option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <button type="submit" formaction="{{route('todo.update', ['id' => $todo->id])}}" class="bg-transparent hover:bg-[#fa9770] text-[#fa9770] font-semibold hover:text-white py-2 px-3 border border-[#fa9770] hover:border-transparent rounded">
                    更新
                  </button>
                </td>
                <td>
                  <button type="submit" formaction="{{route('todo.delete', ['id' => $todo->id])}}" class="bg-transparent hover:bg-sky-400 text-sky-400 font-semibold hover:text-white py-2 px-3 border border-sky-400  hover:border-transparent rounded">
                    削除
                  </button>
                </td>
              </tr>
            </form>
            @endforeach
          </tbody>
        </table>
      </div>
      <a href="{{route('dashboard')}}" class="bg-transparent hover:bg-gray-400 text-gray-400 font-semibold hover:text-white py-2 px-3 border border-gray-400  hover:border-transparent rounded">戻る</a>
    </div>
  </div>
</x-app-layout>