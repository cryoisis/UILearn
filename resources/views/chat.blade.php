@extends('layouts.app')

@section('title', 'AI Chat — UIlearn')

@section('content')
<section class="mx-auto max-w-4xl px-4 py-6 sm:px-6 sm:py-8">
  <div class="glass flex h-[calc(100svh-8.5rem)] min-h-[480px] flex-col overflow-hidden">
    <div class="flex items-center justify-between gap-3 border-b border-[#363B6C]/10 px-4 py-3 dark:border-[#EAEDFE]/10 sm:px-5">
      <div class="min-w-0">
        <h1 class="truncate text-sm font-semibold">AI Chat</h1>
        <p id="chat-status" class="muted truncate font-mono text-[11px] uppercase tracking-wider">
          @if (auth()->user()->isPro()) Pro · tanpa batas pesan @else Free · sisa {{ $remaining }} pesan hari ini @endif
        </p>
      </div>
      <div class="flex items-center gap-2">
        @unless (auth()->user()->isPro())
          <a href="{{ route('subscription') }}" class="btn-ghost shrink-0">Upgrade ke Pro</a>
        @endunless
        <button id="chat-clear" type="button" data-url="{{ route('chat.clear') }}" class="btn-ghost shrink-0">Hapus chat</button>
      </div>
    </div>

    <div id="chat-log" class="flex-1 space-y-5 overflow-y-auto px-4 py-5 sm:px-5" aria-live="polite" aria-label="Percakapan"></div>

    <div class="border-t border-[#363B6C]/10 p-3 dark:border-[#EAEDFE]/10 sm:p-4">
      <div id="chat-chips" class="mb-3 flex gap-2 overflow-x-auto pb-1" role="group" aria-label="Pertanyaan saran">
        @foreach ($presets as $q)
          <button type="button" class="chip shrink-0" data-q="{{ $q }}">{{ $q }}</button>
        @endforeach
      </div>
      <form id="chat-form" action="{{ route('chat.send') }}" method="POST" class="glass-recessed flex items-end gap-2 p-2">
        <textarea id="chat-input" rows="1" maxlength="2000" aria-label="Pertanyaan Anda" placeholder="Tanyakan soal tata letak, warna, atau typography…"
          class="max-h-40 min-h-[2.5rem] flex-1 resize-none bg-transparent px-3 py-2 text-sm outline-none placeholder:text-[#363B6C]/60 dark:placeholder:text-[#EAEDFE]/55"></textarea>
        <button id="chat-send" type="submit" class="btn-primary !px-4 !py-2.5 disabled:cursor-wait">Kirim</button>
      </form>
    </div>
  </div>
</section>

<script type="application/json" id="chat-history">@json($messages)</script>
@endsection
