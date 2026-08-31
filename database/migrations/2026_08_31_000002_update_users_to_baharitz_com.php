<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Populates a username for each user and updates their email domain
     * to baharitz.com.
     */
    public function up(): void
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            // Derive a unique username from the user's name.
            $username = $this->slugify($user->name);

            // Fall back to the local part of the email if the name is empty.
            if (!$username) {
                $username = strtolower(explode('@', $user->email)[0]);
            }

            // Ensure uniqueness against existing usernames.
            $username = $this->ensureUnique($username, $user->id);

            // Rebuild email using the baharitz.com domain.
            $localPart = explode('@', $user->email)[0];
            $newEmail = $localPart . '@baharitz.com';

            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'username' => $username,
                    'email' => $newEmail,
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->update(['username' => null]);

        $users = DB::table('users')->get();
        foreach ($users as $user) {
            $localPart = explode('@', $user->email)[0];
            DB::table('users')
                ->where('id', $user->id)
                ->update(['email' => $localPart . '@feedtan.com']);
        }
    }

    private function slugify(string $name): string
    {
        $slug = strtolower(trim(preg_replace('/\s+/', '.', $name)));
        $slug = preg_replace('/[^a-z0-9._-]/', '', $slug);
        return $slug;
    }

    private function ensureUnique(string $username, int $ignoreId): string
    {
        $base = $username;
        $n = 1;
        while (DB::table('users')->where('username', $username)->where('id', '!=', $ignoreId)->exists()) {
            $username = $base . $n;
            $n++;
        }
        return $username;
    }
};
