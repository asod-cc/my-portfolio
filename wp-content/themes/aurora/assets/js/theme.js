/**
 * Aurora theme interactions. No dependencies.
 */
(() => {
	const doc = document.documentElement;
	doc.classList.add('ak-js');
	const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	/* Sticky header background after scrolling */
	const header = document.querySelector('.ak-header');
	if (header) {
		const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 12);
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	}

	/* Reveal on scroll */
	const revealables = document.querySelectorAll('.ak-reveal, .ak-stagger');
	if ('IntersectionObserver' in window && !reduced) {
		const io = new IntersectionObserver((entries) => {
			entries.forEach((e) => {
				if (e.isIntersecting) {
					e.target.classList.add('is-visible');
					io.unobserve(e.target);
				}
			});
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
		revealables.forEach((el) => io.observe(el));
	} else {
		revealables.forEach((el) => el.classList.add('is-visible'));
	}

	/* Card spotlight follows the cursor */
	document.addEventListener('pointermove', (e) => {
		const card = e.target.closest && e.target.closest('.ak-card');
		if (!card) return;
		const r = card.getBoundingClientRect();
		card.style.setProperty('--mx', `${e.clientX - r.left}px`);
		card.style.setProperty('--my', `${e.clientY - r.top}px`);
	}, { passive: true });

	/* Count-up numbers: <p class="ak-stat-num" data-count="350" data-suffix="+"> */
	const counters = document.querySelectorAll('[data-count]');
	const runCounter = (el) => {
		const target = parseFloat(el.dataset.count);
		const suffix = el.dataset.suffix || '';
		if (reduced) { el.textContent = target + suffix; return; }
		const start = performance.now();
		const dur = 1600;
		const tick = (t) => {
			const p = Math.min(1, (t - start) / dur);
			const eased = 1 - Math.pow(1 - p, 3);
			el.textContent = Math.round(target * eased) + suffix;
			if (p < 1) requestAnimationFrame(tick);
		};
		requestAnimationFrame(tick);
	};
	if ('IntersectionObserver' in window) {
		const co = new IntersectionObserver((entries) => {
			entries.forEach((e) => { if (e.isIntersecting) { runCounter(e.target); co.unobserve(e.target); } });
		}, { threshold: 0.4 });
		counters.forEach((c) => co.observe(c));
	}

	/* Hero "AI build" console: types prompts, then ticks off build steps */
	const prompt = document.querySelector('.ak-prompt');
	if (prompt) {
		const typed = prompt.querySelector('.ak-prompt-typed');
		const steps = [...prompt.querySelectorAll('.ak-prompt-steps li')];
		const score = prompt.querySelector('.ak-prompt-score');
		const phrases = (prompt.dataset.prompts || '').split('|').filter(Boolean);
		let idx = 0;

		const sleep = (ms) => new Promise((r) => setTimeout(r, ms));
		const type = async (text) => {
			typed.textContent = '';
			for (const ch of text) {
				typed.textContent += ch;
				await sleep(reduced ? 0 : 28 + Math.random() * 40);
			}
		};
		const cycle = async () => {
			while (true) {
				steps.forEach((s) => s.classList.remove('is-on'));
				score && score.classList.remove('is-on');
				await type(phrases[idx % phrases.length] || typed.textContent);
				await sleep(450);
				for (const s of steps) { s.classList.add('is-on'); await sleep(reduced ? 0 : 520); }
				score && score.classList.add('is-on');
				await sleep(4200);
				idx++;
			}
		};
		if (typed && phrases.length) {
			if (reduced) {
				typed.textContent = phrases[0];
				steps.forEach((s) => s.classList.add('is-on'));
				score && score.classList.add('is-on');
			} else {
				cycle();
			}
		}
	}

	/* Quick-answer assistant (scripted, runs entirely in the browser) */
	const bot = document.querySelector('.ak-assistant');
	if (bot) {
		const toggle = bot.querySelector('.ak-assistant-toggle');
		const log = bot.querySelector('.ak-assistant-log');
		const form = bot.querySelector('.ak-assistant-form');
		const input = form.querySelector('input');
		const contact = bot.dataset.contact || '/contact/';
		const work = bot.dataset.work || '/work/';

		const answers = [
			{ k: ['price', 'cost', 'budget', 'quote', 'rate', 'how much'], a: `Most business websites start from $1,500, WooCommerce stores from $6,000. Every project gets a fixed quote after a short discovery call. <a href="${contact}">Request a quote →</a>` },
			{ k: ['time', 'long', 'timeline', 'deadline', 'weeks', 'fast'], a: 'A typical brochure site takes 2–4 weeks; larger stores and custom builds 6–10 weeks. Rush delivery is possible.' },
			{ k: ['elementor', 'bricks', 'builder', 'gutenberg', 'block', 'divi'], a: 'I build with Elementor, Bricks, or native Gutenberg blocks, whichever fits your team. Every site is handed over so you can edit it visually without code.' },
			{ k: ['woo', 'shop', 'store', 'ecommerce', 'e-commerce', 'payment'], a: 'Yes: WooCommerce stores with payments, subscriptions, bookings, multi-currency and custom checkout flows.' },
			{ k: ['ai', 'chatbot', 'gpt', 'automation', 'openai', 'claude'], a: 'I add practical AI: on-site assistants like this one, smart search, AI-assisted content workflows and automated QA, always with you in control.' },
			{ k: ['speed', 'slow', 'performance', 'vitals', 'seo', 'pagespeed'], a: 'Performance is built in: lean themes, image optimisation, caching and CDN. Targets are 90+ PageSpeed and green Core Web Vitals.' },
			{ k: ['maintenance', 'care', 'support', 'update', 'security', 'hack', 'backup'], a: 'Care plans cover updates, daily backups, uptime monitoring, security hardening and small edits every month.' },
			{ k: ['work', 'portfolio', 'example', 'project', 'case'], a: `Have a look at selected projects here: <a href="${work}">View the work →</a>` },
			{ k: ['experience', 'years', 'who', 'about', 'asad'], a: 'Asad has 10 years of hands-on web development experience across every kind of site: corporate, e-commerce, membership, LMS, directories and more.' },
			{ k: ['hello', 'hi', 'hey', 'salam'], a: 'Hi! Ask me about pricing, timelines, page builders, WooCommerce or AI features.' },
			{ k: ['contact', 'email', 'call', 'hire', 'start', 'book'], a: `Great, let's talk. <a href="${contact}">Open the contact form →</a>` },
		];
		const fallback = `Good question. Asad can answer that personally. <a href="${contact}">Send a message →</a>`;

		const add = (html, who) => {
			const m = document.createElement('div');
			m.className = `ak-msg ${who}`;
			m.innerHTML = html;
			log.appendChild(m);
			log.scrollTop = log.scrollHeight;
			return m;
		};
		const escape = (s) => s.replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
		const reply = (q) => {
			add(escape(q), 'me');
			const t = add('<span class="ak-typing"><span></span><span></span><span></span></span>', 'bot');
			const lq = q.toLowerCase();
			const hit = answers.find((x) => x.k.some((k) => lq.includes(k)));
			setTimeout(() => { t.innerHTML = hit ? hit.a : fallback; log.scrollTop = log.scrollHeight; }, reduced ? 0 : 700);
		};

		toggle.addEventListener('click', () => {
			const open = bot.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', String(open));
			if (open) setTimeout(() => input.focus(), 200);
		});
		bot.querySelectorAll('.ak-assistant-chips button').forEach((b) => b.addEventListener('click', () => reply(b.textContent)));
		form.addEventListener('submit', (e) => {
			e.preventDefault();
			const q = input.value.trim();
			if (!q) return;
			input.value = '';
			reply(q);
		});
		document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && bot.classList.contains('is-open')) toggle.click(); });
	}
})();
