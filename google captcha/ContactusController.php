<?php


public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s\-\.]+$/'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'regex:/^\+?[0-9\s\-]{7,20}$/'],
            'type' => ['required', 'string', 'max:150'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:1000'],
            'g-recaptcha-response' => ['required'],
        ]);

        // Verify reCAPTCHA with Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$response->json('success')) {
            Toastr::error('Google reCAPTCHA verification failed. Please try again.', 'Error');
        }

        // Continue with storing
        $validated = $request->only('name', 'email', 'phone', 'type', 'subject', 'message');
        $validated['name'] = strip_tags($validated['name']);
        $validated['email'] = strip_tags($validated['email']);
        $validated['phone'] = strip_tags($validated['phone']);
        $validated['type'] = strip_tags($validated['type']);
        $validated['subject'] = strip_tags($validated['subject']);
        $validated['message'] = strip_tags($validated['message']);
        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        ContactUs::insert($validated);

        Toastr::success('Message sent successfully :)', 'Success');
        return back();
    }