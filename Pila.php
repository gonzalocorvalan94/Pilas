<?php

class Pila
{
    private array $items = [];

    public function __construct(int ...$items)
    {
        $this->items = $items;
    }

    public function getTope(): int
    {
        if ($this->vacia()) {
            throw new UnderflowException("No se puede ver el tope: la pila está vacía");
        }
        return $this->items[count($this->items) - 1];
    }

    public function apilar(int $elemento): void
    {
        array_push($this->items, $elemento);
    }

    public function desapilar(): int
    {
        if ($this->vacia()) {
            throw new UnderflowException("No se puede desapilar: la pila está vacía");
        }
        return array_pop($this->items);
    }

    public function vacia(): bool
    {
        return empty($this->items);
    }

    public function imprimir(): void
    {
        for ($i = count($this->items) - 1; $i >= 0; $i--) {
            echo $this->items[$i] . PHP_EOL;
        }
    }


    private function invertir():Pila{
        $aux1 = $this->copiar();
        $aux2 = new Pila();

        while(!$aux1->vacia()){
            $aux2->apilar($aux1->desapilar());
        }
        return $aux2;
    }

    private function contarElementos(Pila $pila): int
    {
        $aux = new Pila();
        $contador = 0;

        while (!$pila->vacia()) {
            $aux->apilar($pila->desapilar());
            $contador++;
        }
        while (!$aux->vacia()) {
            $pila->apilar($aux->desapilar());
        }

        return $contador;
    }

    private function compararTamanio(Pila $pila1): int
    {
        $contador1 = $this->contarElementos($this);
        $contador2 = $this->contarElementos($pila1);

        if ($contador1 > $contador2) {
            return 1;
        }
        if ($contador1 < $contador2) {
            return -1;
        }

        return 0;
    }

    

    private function sonIguales(Pila $pila1): bool
    {
        if ($this->compararTamanio($pila1) != 0) {
            return false;
        }

        $aux1 = new Pila();
        $aux2 = new Pila();
        $flag = true;

        while (!$this->vacia() && !$pila1->vacia()) {
            $elemento1 = $this->desapilar();
            $elemento2 = $pila1->desapilar();

            if ($elemento1 != $elemento2) {
                $flag = false;
            }

            $aux1->apilar($elemento1);
            $aux2->apilar($elemento2);
        }

        while (!$aux1->vacia()) {
            $this->apilar($aux1->desapilar());
        }
        while (!$aux2->vacia()) {
            $pila1->apilar($aux2->desapilar());
        }

        return $flag;
    }

    private function copiar(): Pila
    {
        $aux1 = new Pila();
        $aux2 = new Pila();
        $copia = new Pila();

        while (!$this->vacia()) {
            $elemento = $this->desapilar();
            $aux1->apilar($elemento);
            $aux2->apilar($elemento);
        }
        while (!$aux1->vacia()) {
            $this->apilar($aux1->desapilar());
        }
        while (!$aux2->vacia()) {
            $copia->apilar($aux2->desapilar());
        }

        return $copia;
    }

    
}
