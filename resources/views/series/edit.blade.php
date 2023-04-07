<x-layout title="Editar Série {{ $series->name }}">

    <x-series.errors :errors="$errors"/>

    <x-series.form :action="route('series.update', $series->id)" :update='true' :name="$series->name" />
</x-layout>
