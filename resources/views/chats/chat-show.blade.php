<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="top-0 sticky z-10 items-center text-white border rounded-t-xl bg-blue-500 px-5 py-4 xl:px-6 ">
                        <h1 class="font-medium text-bodydark2">{{ $contact->name }}</h1>
                </div>
                    <div class="overflow-y-auto p-5 h-[calc(100vh-270px)] bg-gray-50">
                        <div id="chat-container">
                    @foreach ($messages as $message)
                        @if ($message->from_user_id === Auth::id())
                                <div class="text-right max-w-[320px] ms-auto bg-blue-500 rounded-b-xl rounded-l-xl py-1 px-5 text-white my-1">
                                    <p>{{ $message->message}}</p>
                                    <span class="text-xs text-blue-300">{{ date('g:i A', strtotime($message->created_at)) }}</span>
                            </div>
                        @else
                            <div class="flex flex-col w-full max-w-[320px] leading-1.5 px-5 py-1 bg-gray-300 rounded-e-xl rounded-es-xl my-1">
                                    <p>{{ $message->message}}</p>
                                    <span class="text-xs text-gray-400">{{ date('g:i A', strtotime($message->created_at)) }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
                    </div>
                <div class="sticky bottom-0 border-t bg-gray-200 p-3 rounded-b-xl bg-white ">
                        <form action="{{ route('chat.send', $contactId) }}" method="POST" class="flex items-center justify-between">
                        @csrf
                        <div class="relative w-full">
                                <input name="message" type="text" placeholder="Input message" required class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                        </div>
                        <div class="flex items-center">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const userId = @json(auth()->user()->id);
        const contactId = @json($contactId);
        const messages = @json($messages);

        function formatTime(dateString) {
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            };
            const date = new Date(dateString);
            return date.toLocaleString('en-US', options);
        }

        document.addEventListener('DOMContentLoaded', function() {
            window.Echo.private(`chat.${userId}`)
                .listen('.message-sent', (event) => {
                    console.log('Nuevo mensaje recibido:', event.message);
                    const messageContainer = document.getElementById('chat-container');
                    const messageElement = document.createElement('div');

                    const formattedTime = formatTime(event.message.created_at);
                    messageElement.classList.add('flex', 'flex-col', 'w-full', 'max-w-[320px]', 'leading-1.5',
                        'px-5', 'py-1', 'bg-gray-300', 'rounded-e-xl', 'rounded-es-xl', 'my-1');
                    messageElement.innerHTML = `
                        <p>${event.message.message}</p>
                        <span class="text-xs text-gray-400">${formattedTime}</span>
                    `;

                    messageContainer.appendChild(messageElement);
                    messageContainer.scrollTop = messageContainer.scrollHeight;
                });
        });
    </script>

</x-app-layout>
