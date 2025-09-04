@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 14V16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">User Details</h1>
                    </div>
                    <p class="text-gray-600 pl-11">View detailed information for {{ $user->name }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.users.edit', $user) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21H6.75L17.81 9.94L14.06 6.19L3 17.25ZM20.71 7.04C21.1 6.65 21.1 6.02 20.71 5.63L18.37 3.29C17.98 2.9 17.35 2.9 16.96 3.29L15.13 5.12L18.88 8.87L20.71 7.04Z"/>
                        </svg>
                        Edit User
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

        <!-- User Information -->
        <div class="px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- User Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="text-center">
                            <!-- Avatar -->
                            <div class="mx-auto h-24 w-24 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                                <span class="text-indigo-600 font-bold text-2xl">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                            </div>
                            
                            <!-- Name and Email -->
                            <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $user->name }}</h2>
                            <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                            
                            <!-- Status Badges -->
                            <div class="flex justify-center gap-2 mb-6">
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                    {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                                </span>
                            </div>
                            
                            <!-- Quick Actions -->
                            <div class="space-y-2">
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full bg-{{ $user->email_verified_at ? 'red' : 'green' }}-600 hover:bg-{{ $user->email_verified_at ? 'red' : 'green' }}-700 text-white px-4 py-2 rounded-md transition-colors duration-200">
                                            {{ $user->email_verified_at ? 'Deactivate' : 'Activate' }} User
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition-colors duration-200">
                                            Delete User
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-md p-3">
                                        <p class="text-sm text-yellow-800">This is your account. You cannot deactivate or delete it.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Information -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 12C14.21 12 16 10.21 16 8S14.21 4 12 4 8 5.79 8 8 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z"/>
                            </svg>
                            Basic Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <p class="text-gray-900">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <p class="text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <p class="text-gray-900">{{ $user->phone ?: 'Not provided' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">User Role</label>
                                <p class="text-gray-900">{{ ucfirst($user->role) }}</p>
                            </div>
                        </div>
                        
                        @if($user->bio)
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                <p class="text-gray-900">{{ $user->bio }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Account Status -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM12 7C13.1 7 14 7.9 14 9S13.1 11 12 11 10 10.1 10 9 10.9 7 12 7ZM18 15C16.59 15 15.1 14.65 13.86 14.08C13.66 13.98 13.51 13.81 13.51 13.61V12.49C14.27 12.81 15.11 13 16 13C16.89 13 17.73 12.81 18.49 12.49V13.61C18.49 13.81 18.34 13.98 18.14 14.08C16.9 14.65 15.41 15 14 15H18Z"/>
                            </svg>
                            Account Status
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email Verification</label>
                                <div class="flex items-center gap-2">
                                    @if($user->email_verified_at)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"/>
                                        </svg>
                                        <span class="text-green-600 font-medium">Verified</span>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z"/>
                                        </svg>
                                        <span class="text-red-600 font-medium">Not Verified</span>
                                    @endif
                                </div>
                                @if($user->email_verified_at)
                                    <p class="text-sm text-gray-500 mt-1">Verified on {{ $user->email_verified_at->format('M d, Y \\a\\t g:i A') }}</p>
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Account Status</label>
                                <div class="flex items-center gap-2">
                                    @if($user->email_verified_at)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"/>
                                        </svg>
                                        <span class="text-green-600 font-medium">Active</span>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM15.5 6L12 9.5L8.5 6L7 7.5L10.5 11L7 14.5L8.5 16L12 12.5L15.5 16L17 14.5L13.5 11L17 7.5L15.5 6Z"/>
                                        </svg>
                                        <span class="text-red-600 font-medium">Inactive</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timestamps -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM13 17H11V11H13V17ZM13 9H11V7H13V9Z"/>
                            </svg>
                            Account Timeline
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-700">Account Created</span>
                                <span class="text-sm text-gray-900">{{ $user->created_at->format('M d, Y \\a\\t g:i A') }}</span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-700">Last Updated</span>
                                <span class="text-sm text-gray-900">{{ $user->updated_at->format('M d, Y \\a\\t g:i A') }}</span>
                            </div>
                            @if($user->email_verified_at)
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-sm font-medium text-gray-700">Email Verified</span>
                                    <span class="text-sm text-gray-900">{{ $user->email_verified_at->format('M d, Y \\a\\t g:i A') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection