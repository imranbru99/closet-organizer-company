<div
    x-data="{
        open: false,
        loading: false,
        input: '',
        messages: [{ role: 'assistant', text: 'Hi — ask Nestline about walk-ins, reach-ins, pricing, or timelines.' }],
        async send() {
            if (!this.input.trim() || this.loading) return;
            const text = this.input.trim();
            this.messages.push({ role: 'user', text });
            this.input = '';
            this.loading = true;
            try {
                const res = await fetch('{{ route('ai.chat') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: text })
                });
                const data = await res.json();
                this.messages.push({ role: 'assistant', text: data.reply || 'Sorry, try again in a moment.' });
            } catch (e) {
                this.messages.push({ role: 'assistant', text: 'Connection issue — please call {{ $brand['phone'] ?? '(512) 555-0148' }}.' });
            } finally {
                this.loading = false;
                this.$nextTick(() => { this.$refs.thread.scrollTop = this.$refs.thread.scrollHeight; });
            }
        }
    }"
    class="nl-chat"
>
    <div x-show="open" x-cloak class="mb-3 overflow-hidden rounded-2xl border border-[color:var(--nl-ink)]/10 bg-white shadow-xl">
        <div class="bg-[color:var(--nl-teal)] px-4 py-3 text-sm font-semibold text-white">Nestline AI Concierge</div>
        <div x-ref="thread" class="max-h-72 space-y-3 overflow-y-auto px-4 py-3 text-sm">
            <template x-for="(m, i) in messages" :key="i">
                <div :class="m.role === 'user' ? 'text-right' : 'text-left'">
                    <span
                        class="inline-block max-w-[90%] rounded-2xl px-3 py-2"
                        :class="m.role === 'user' ? 'bg-[color:var(--nl-soft)] text-[color:var(--nl-ink)]' : 'bg-[color:var(--nl-mist)] text-[color:var(--nl-slate)]'"
                        x-text="m.text"
                    ></span>
                </div>
            </template>
            <p x-show="loading" class="text-xs text-[color:var(--nl-slate)]">Thinking…</p>
        </div>
        <form class="flex gap-2 border-t border-[color:var(--nl-ink)]/8 p-3" @submit.prevent="send">
            <input x-model="input" type="text" placeholder="Ask about closets…" class="w-full rounded-full border border-[color:var(--nl-ink)]/15 px-3 py-2 text-sm outline-none focus:border-[color:var(--nl-teal)]">
            <button type="submit" class="rounded-full bg-[color:var(--nl-teal)] px-3 py-2 text-sm text-white">Send</button>
        </form>
    </div>
    <button
        type="button"
        @click="open = !open"
        class="ml-auto flex h-12 items-center gap-2 rounded-full bg-[color:var(--nl-ink)] px-4 text-sm font-medium text-white shadow-lg"
    >
        <span x-text="open ? 'Close chat' : 'Ask AI'"></span>
    </button>
</div>
