<x-layout title="Nova Série">

    <x-series.errors :errors="$errors"/>

    <x-series.form :action="route('series.store')" :name="old('name')" :update='false'/>
</x-layout>

