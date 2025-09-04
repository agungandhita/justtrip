@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 14V16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Add New User</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Create a new user account</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z"/>
                    </svg>
                    Back to Users
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="px-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('admin.users.store') }}" method="POST" class="p-6">
                    @csrf
                    
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
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                       placeholder="Enter full name">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                       placeholder="Enter email address">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                                <input type="password" id="password" name="password" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('password') border-red-500 @enderror"
                                       placeholder="Enter password">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Password must be at least 8 characters long</p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                       placeholder="Confirm password">
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
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Admin users have full access to the system</p>
                            </div>

                            <!-- Email Verification -->
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="email_verified" value="1" {{ old('email_verified') ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Mark email as verified</span>
                                </label>
                                <p class="mt-1 text-sm text-gray-500">If unchecked, user will need to verify their email address</p>
                            </div>

                            <!-- Phone (Optional) -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
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
                                          placeholder="Enter user bio (optional)">{{ old('bio') }}</textarea>
                                @error('bio')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('admin.users.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-md transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition-colors duration-200">
                                Create User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection