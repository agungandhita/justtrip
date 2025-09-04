@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 14V16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM3 17.25V21H6.75L17.81 9.94L14.06 6.19L3 17.25ZM20.71 7.04C21.1 6.65 21.1 6.02 20.71 5.63L18.37 3.29C17.98 2.9 17.35 2.9 16.96 3.29L15.13 5.12L18.88 8.87L20.71 7.04Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Edit User</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Update user information for {{ $user->name }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.users.show', $user) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5S21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12S9.24 7 12 7S17 9.24 17 12S14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12S10.34 15 12 15S15 13.66 15 12S13.66 9 12 9Z"/>
                        </svg>
                        View User
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z"/>
                        </svg>
                        Back to Users
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="px-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 12C14.21 12 16 10.21 16 8S14.21 4 12 4 8 5.79 8 8 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z"/>
                                    </svg>
                                    Basic Information
                                </h3>
                            </div>

                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                       placeholder="Enter full name">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                       placeholder="Enter email address">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <input type="password" id="password" name="password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('password') border-red-500 @enderror"
                                       placeholder="Enter new password (leave blank to keep current)">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Leave blank to keep current password. Must be at least 8 characters if changing.</p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                       placeholder="Confirm new password">
                                <p class="mt-1 text-sm text-gray-500">Required only if changing password</p>
                            </div>
                        </div>

                        <!-- Account Settings -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM12 7C13.1 7 14 7.9 14 9S13.1 11 12 11 10 10.1 10 9 10.9 7 12 7ZM18 15C16.59 15 15.1 14.65 13.86 14.08C13.66 13.98 13.51 13.81 13.51 13.61V12.49C14.27 12.81 15.11 13 16 13C16.89 13 17.73 12.81 18.49 12.49V13.61C18.49 13.81 18.34 13.98 18.14 14.08C16.9 14.65 15.41 15 14 15H18Z"/>
                                    </svg>
                                    Account Settings
                                </h3>
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
                                <select id="role" name="role" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('role') border-red-500 @enderror">
                                    <option value="">Select Role</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Admin users have full access to the system</p>
                            </div>

                            <!-- Email Verification -->
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="email_verified" value="1" {{ old('email_verified', $user->email_verified_at ? '1' : '') ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Email is verified</span>
                                </label>
                                <p class="mt-1 text-sm text-gray-500">
                                    Current status: 
                                    <span class="font-medium {{ $user->email_verified_at ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}
                                    </span>
                                </p>
                            </div>

                            <!-- Phone (Optional) -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                                       placeholder="Enter phone number (optional)">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Bio (Optional) -->
                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                <textarea id="bio" name="bio" rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('bio') border-red-500 @enderror"
                                          placeholder="Enter user bio (optional)">{{ old('bio', $user->bio) }}</textarea>
                                @error('bio')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Account Info -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Account Information</h4>
                                <div class="text-sm text-gray-600 space-y-1">
                                    <p><span class="font-medium">Created:</span> {{ $user->created_at->format('M d, Y \\a\\t g:i A') }}</p>
                                    <p><span class="font-medium">Last Updated:</span> {{ $user->updated_at->format('M d, Y \\a\\t g:i A') }}</p>
                                    @if($user->email_verified_at)
                                        <p><span class="font-medium">Email Verified:</span> {{ $user->email_verified_at->format('M d, Y \\a\\t g:i A') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('admin.users.show', $user) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-md transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition-colors duration-200">
                                Update User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection