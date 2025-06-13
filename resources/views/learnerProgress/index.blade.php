@extends('layouts.app')

@section('content')
    <div class="my-auto py-10 px-4 sm:px-12 lg:px-12 w-full max-w-[335px] lg:max-w-4xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Learner Progress Dashboard</h1>

        <form method="GET" class="flex flex-col sm:flex-row gap-4 mb-6  bg-white shadow rounded-md p-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Course</label>
                <select name="course_id" onchange="this.form.submit()" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">All Courses</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $courseId == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort by Progress</label>
                <select name="sort" onchange="this.form.submit()" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">No Sorting</option>
                    <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>Lowest to Highest</option>
                    <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>Highest to Lowest</option>
                </select>
            </div>
        </form>

        @forelse($learners as $learner)
            <div class="bg-white shadow rounded-lg mb-6 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">
                    {{ $learner->firstname }} {{ $learner->lastname }}
                </h2>

                <div class="space-y-4">
                    @forelse($learner->enrolments as $enrolment)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">
                                    {{ $enrolment->course->name }}
                                </span>
                                <span class="text-sm font-medium text-gray-700">
                                    {{ number_format($enrolment->progress, 2) }}%
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-blue-500 h-3 rounded-full transition-all duration-300" style="width: {{ $enrolment->progress }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No enrolled courses.</p>
                    @endforelse
                </div>
            </div>
        @empty
            <p class="text-gray-600">No learners found.</p>
        @endforelse
        <div class="mt-6">
            {{ $learners->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
